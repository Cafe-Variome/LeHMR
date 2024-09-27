<?php

namespace App\Controllers;

use App\Models\DatasetModel;
use App\Models\ResearcherModel;
use App\Models\PublicationModel;
use App\Models\ConditionModel;
use App\Models\LinkModel;
use App\Models\UserInfoModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Controller;
use CodeIgniter\Config\Services;
use App\Libraries\EmailLibrary;

class Viewdata extends Controller
{
    protected $datasetModel;
    protected $researcherModel;
    protected $publicationModel;
    protected $conditionModel;
    protected $linkModel;
    protected $encryption;
    protected $db;
    protected $userModel;

    public function __construct()
    {
        $this->datasetModel = new DatasetModel();
        $this->researcherModel = new ResearcherModel();
        $this->publicationModel = new PublicationModel();
        $this->conditionModel = new ConditionModel();
        $this->linkModel = new LinkModel();
        $this->userModel = new UserInfoModel();
        $this->encryption = Services::encrypter(); // Use CodeIgniter's encryption service
        // Initialize database connection
        $this->db = \Config\Database::connect();
    }

    public function index($token = null)
    {
        if ($token === null) {
            return view('errors/no_user', ['message' => 'No token provided.']);
        }
    
        $link = $this->linkModel->where('l_token', $token)->first();
    
        if (!$link) {
            return view('errors/no_user', ['message' => 'No user associated with this token.']);
        }
    
        $tokenCreationTime = new Time($link['created_at']);
        $now = Time::now();
    
        // Check if the token has expired (older than 3 months)
        if ($now->difference($tokenCreationTime)->getMonths() >= 3) {
            $newToken = $this->generateNewToken($link['u_id']);
            $this->sendAccessLink($link['u_id'], $newToken);
    
            return view('errors/token_expired', ['message' => 'Your access token has expired. A new link has been sent to your email.']);
        }
    
        $perPage = 10; // Number of records per page
    
        // Active datasets pagination
        $activeDatasets = $this->datasetModel->where('u_id', $link['u_id'])->where('archived', 0)
            ->paginate($perPage, 'active');
        $activePaginationLinks = $this->datasetModel->pager->links('active', 'default_full');
    
        // Archived datasets pagination
        $archivedDatasets = $this->datasetModel->where('u_id', $link['u_id'])->where('archived', 1)
            ->paginate($perPage, 'archived');
        $archivedPaginationLinks = $this->datasetModel->pager->links('archived', 'default_full');
    
        // Encrypt dataset IDs for secure frontend usage
        foreach ($activeDatasets as &$dataset) {
            $dataset['encrypted_id'] = $this->encrypt($dataset['d_id']);
        }
    
        foreach ($archivedDatasets as &$dataset) {
            $dataset['encrypted_id'] = $this->encrypt($dataset['d_id']);
        }
    
        return view('viewdata/view', [
            'activeDatasets' => $activeDatasets,
            'archivedDatasets' => $archivedDatasets,
            'activePaginationLinks' => $activePaginationLinks,
            'archivedPaginationLinks' => $archivedPaginationLinks,
            'token' => $token,
            'message' => empty($activeDatasets) && empty($archivedDatasets) ? 'No records found.' : ''
        ]);
    }
    

    public function delete()
    {
        $encrypted_id = $this->request->getPost('d_id');
        $d_id = $this->decrypt($encrypted_id);

        $this->db->transStart();

        try {
            $this->researcherModel->where('d_id', $d_id)->delete();
            $this->publicationModel->where('d_id', $d_id)->delete();
            $this->conditionModel->where('d_id', $d_id)->delete();
            $this->datasetModel->delete($d_id);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON(['success' => true, 'message' => 'Dataset deleted successfully.']);
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Failed to delete dataset: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete the dataset.']);
        }
    }

    public function archive()
    {
        $encrypted_id = $this->request->getPost('d_id');
        $d_id = $this->decrypt($encrypted_id);

        $this->db->transStart();

        try {
            $this->researcherModel->where('d_id', $d_id)->set(['archived' => 1])->update();
            $this->publicationModel->where('d_id', $d_id)->set(['archived' => 1])->update();
            $this->conditionModel->where('d_id', $d_id)->set(['archived' => 1])->update();
            $this->datasetModel->where('d_id', $d_id)->set(['archived' => 1])->update();

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON(['success' => true, 'message' => 'Dataset archived successfully.']);
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Failed to archive dataset: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to archive the dataset.']);
        }
    }

    public function restore()
    {
        $encrypted_id = $this->request->getPost('d_id');
        $d_id = $this->decrypt($encrypted_id);

        $this->db->transStart();

        try {
            $this->researcherModel->where('d_id', $d_id)->set(['archived' => 0])->update();
            $this->publicationModel->where('d_id', $d_id)->set(['archived' => 0])->update();
            $this->conditionModel->where('d_id', $d_id)->set(['archived' => 0])->update();
            $this->datasetModel->where('d_id', $d_id)->set(['archived' => 0])->update();

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON(['success' => true, 'message' => 'Dataset restored successfully.']);
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Failed to restore dataset: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to restore the dataset.']);
        }
    }

    private function encrypt($data)
    {
        return bin2hex($this->encryption->encrypt($data));
    }

    private function decrypt($data)
    {
        log_message('error', 'Failed to decrypt id: ' . $data );
        return $this->encryption->decrypt(hex2bin($data));
    }

    private function generateNewToken($user_id)
    {
        $newToken = bin2hex(random_bytes(16));
        $this->linkModel->where('u_id', $user_id)->set(['l_token' => $newToken])->update();
        return $newToken;
    }

    private function sendAccessLink($userEmail,$userName,$token)
    {
        $link = base_url("viewdata/index/{$token}");
        $emailLib = new EmailLibrary();


        if (!$emailLib->sendAccessLink($userEmail,$userName,$link)) {
            log_message('error', 'Failed to send access link email to user: ' . $user['u_email']);
        }
    }

    public function requestAccess()
    {
        if ($this->request->getMethod() === 'post') {
            $fname = $this->request->getPost('u_fname');
            $lname = $this->request->getPost('u_lname');
            $email = $this->request->getPost('u_email');

            // Debugging
            log_message('info', 'Searching for user with u_fname: ' . $fname . ', u_lname: ' . $lname . ', u_email: ' . $email);

            // Check if the user exists
            // Use the findUser method to retrieve the user
            $user = $this->userModel->findUser($fname, $lname, $email);

            if ($user) {
                $link = $this->linkModel->where('u_id', $user['u_id'])->first();
                $tokenCreationTime = new Time($link['created_at']);
                $now = Time::now();

                // Check if the token has expired
                if ($now->difference($tokenCreationTime)->getMonths() >= 3) {
                    $newToken = $this->generateNewToken($user['u_id']);
                    $this->sendAccessLink($user['u_email'],$user['u_fname'], $newToken);
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Your access token has expired. A new link has been sent to your email.'
                    ]);
                } else {
                    $this->sendAccessLink($user['u_email'],$user['u_fname'], $link['l_token']);
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'An access link has been sent to your registered email.'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No record found. Please create a new dataset.'
                ]);
            }
        }

        return view('viewdata/index');
    }

    public function getDatasetDetails()
    {
        $datasetId = $this->request->getPost('id');
        $d_id = $this->decrypt($datasetId);
        // Fetch dataset details from the database
        $datasetModel = new DatasetModel();
        $data = $datasetModel->getDatasetWithDetails($d_id);
        $data['id'] = $d_id;

        if ($data) {
            return $this->response->setJSON(['success' => true, 'data' => $data]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Dataset not found']);
        }
    }


}
