<?php

/**
 * LeHMR is a health metadata resource used to capture information regarding metadata to allow discovery.
 * This has been created by Brookeslab for which Prof Tony Brookes is the lead.
 * @author Umar Riaz
 * Created at 14/08/2024
 */

namespace App\Controllers;

use App\Models\DatasetModel;
use App\Models\UserInfoModel;
use App\Models\LinkModel;
use App\Models\ResearcherModel;
use App\Models\PublicationModel;
use App\Models\ConditionModel;
use CodeIgniter\Controller;
use Ramsey\Uuid\Uuid;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\EmailLibrary;

class Getdata extends BaseController
{
    protected $datasetModel;
    protected $userInfoModel;
    protected $linkModel;
    protected $researcherModel;
    protected $publicationModel;
    protected $conditionModel;
    protected $db;

    public function __construct()
    {
        $this->datasetModel = new DatasetModel();
        $this->userInfoModel = new UserInfoModel();
        $this->linkModel = new LinkModel();
        $this->researcherModel = new ResearcherModel();
        $this->publicationModel = new PublicationModel();
        $this->conditionModel = new ConditionModel();
        $this->db = \Config\Database::connect(); // Initialize the database connection
    }
	public function index()
	{
		return view('getdata/getdata');
	}
	public function validateStep(){
		$validation = \Config\Services::validation();
		$step = $this->request->getPost('step');
		$response = ['success' => false, 'errors' => []];

		switch ($step) {
			case 'one':
				$validation->setRules([
					'u_fname' => [
						'label' => 'Username',
						'rules' => 'required|min_length[3]|alpha_numeric',
						'errors' => [
							'required' => 'User first name cannot be empty.',
							'alpha_numeric' => 'The user first name may only contain letters and numbers.',
						],
					],
					'u_lname' => [
						'label' => 'Last Name',
						'rules' => 'required|min_length[3]|alpha_numeric',
						'errors' => [
							'required' => 'User last name cannot be empty.',
							'alpha_numeric' => 'The user last name may only contain letters and numbers.',
						],
					],
					'u_email' => [
						'label' => 'Email Address',
						'rules' => 'required|valid_email',
						'errors' => [
							'required' => 'Email address cannot be empty.',
							'valid_email' => 'Please enter a valid email address.',
						],
					],
					'u_role' => [
						'label' => 'User Role',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
						'regex_match' => 'The user role may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
				]);
				break;
			case "two":
				$validation->setRules([
					'd_title' => [
						'label' => 'Title',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]|max_length[500]',
						'errors' => [
							'required' => 'The title cannot be empty.',
							'regex_match' => 'The title may only contain letters, numbers, spaces, semicolons, periods, and commas.',
							'max_length' => 'The title cannot exceed 200 characters.'
						]
					],
					'd_abstract' => [
						'label' => 'Abstract',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]|max_length[500]',
						'errors' => [
							'required' => 'The abstract cannot be empty.',
							'regex_match' => 'The abstract may only contain letters, numbers, spaces, semicolons, periods, and commas.',
							'max_length' => 'The abstract cannot exceed 500 characters.'
						]
					],
					'd_datatheme' => [
						'label' => 'Data Theme',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'regex_match' => 'The data theme may only contain letters, numbers, spaces, semicolons, periods, and commas.'
						]
					],
					'd_funders' => [
						'label' => 'Funders',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'regex_match' => 'The funders may only contain letters, numbers, spaces, semicolons, periods, and commas.'
						]
					],
					'd_ethnicity' => [
						'label' => 'Ethnicity',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
						'regex_match' => 'The ethnicity may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'd_datatypes' => [
						'label' => 'Data Types',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
						'required' => 'The data types cannot be empty.',
						'regex_match' => 'The data types may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'd_keywords' => [
						'label' => 'Keywords',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
						'required' => 'The keywords cannot be empty.',
						'regex_match' => 'The keywords may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'd_researchstudy' => [
						'label' => 'Research Study',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
						'required' => 'The research study cannot be empty.',
						'regex_match' => 'The research study may only contain letters, numbers, spaces, semicolons, periods, and commas.',
					],
					],
					'd_geography' => [
						'label' => 'Geography',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
						'regex_match' => 'The geography may only contain letters, numbers, spaces, semicolons, periods, and commas.',
					],
					],
					'd_studysize' => [
						'label' => 'Study Size',
						'rules' => 'permit_empty|numeric|greater_than_equal_to[0]',
						'errors' => [
						'numeric' => 'The study size must be a number.',
						'greater_than_equal_to' => 'The study size must be at least 0.',
					],
					],
					'd_agerange' => [
						'label' => 'Age Range',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:-]+$/]',
						'errors' => [
						'regex_match' => 'The age range may only contain letters, numbers, spaces, semicolons, periods, and commas.',
					],
					],
					'd_arights' => [
						'label' => 'Access Rights',
						'rules' => 'required|valid_url',
						'errors' => [
						'required' => 'The access rights URL cannot be empty.',
						'valid_url' => 'Please provide a valid URL for access rights.',
					],
					],
					'd_organisation' => [
						'label' => 'Organisation',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
						'required' => 'The organisation cannot be empty.',
						'regex_match' => 'The organisation may only contain letters, numbers, spaces, semicolons, periods, and commas.',
					],
					],
					'd_conpoint' => [
						'label' => 'Contact Point',
						'rules' => 'required|valid_email',
						'errors' => [
						'required' => 'The contact point cannot be empty.',
							'valid_email' => 'Please enter valid email.',
						],
					],
					'd_legaljurisdiction' => [
						'label' => 'Legal Jurisdiction',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;]+$/]',
						'errors' => [
							'required' => 'The legal jurisdiction cannot be empty.',
							'regex_match' => 'The legal jurisdiction may only contain letters, numbers, spaces, semicolons, periods, and commas.'
						]
					],
					'd_controler' => [
						'label' => 'Data Controller',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;]+$/]',
						'errors' => [
							'required' => 'The data controller cannot be empty.',
							'regex_match' => 'The legal jurisdiction may only contain letters, numbers, spaces, semicolons, periods, and commas.'
						]
					],
					'd_hdrconsent' => [
						'label' => 'HDR Consent',
						'rules' => 'required|in_list[0,1]',
						'errors' => [
							'required' => 'HDR consent is required.',
							'in_list' => 'HDR consent must be either Yes or No.',
						]
					],

				]);
				break;
			case 'three':
				# code...
				$validation->setRules([
					'researcher.*.title' => [
						'label' => 'Title',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'regex_match' => 'The title may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'researcher.*.email' => [
						'label' => 'Email',
						'rules' => 'required|valid_email',
						'errors' => [
							'required' => 'The email address is required.',
							'valid_email' => 'Please provide a valid email address.',
						],
					],
					'researcher.*.forename' => [
						'label' => 'Forename',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'required' => 'The forename is required.',
							'regex_match' => 'The forename may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'researcher.*.surname' => [
						'label' => 'Surname',
						'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'required' => 'The surname is required.',
							'regex_match' => 'The surname may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'researcher.*.affiliations' => [
						'label' => 'Affiliations',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'regex_match' => 'The affiliations may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
				]);
				break;
			case 'four':
				$validation->setRules([
					
					'c_allowedcountries' => [
						'label' => 'Allowed Countries',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'regex_match' => 'The allowed countries may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'c_profituse' => [
						'label' => 'Profit Use',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'regex_match' => 'The profit use may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'c_contact' => [
						'label' => 'Recontact',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'regex_match' => 'The recontact may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'c_bru' => [
						'label' => 'Broad Research Uses',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'regex_match' => 'The broad research uses may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					'c_sru' => [
						'label' => 'Specific Research Uses',
						'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
						'errors' => [
							'regex_match' => 'The specific research uses may only contain letters, numbers, spaces, semicolons, periods, and commas.',
						],
					],
					
				]);
				break;
			case 'five':
				$validation->setRules([
					'pub.*.title' => [
						'label' => 'Publication Title',
						'rules' => 'required|alpha_numeric_space|max_length[255]',
						'errors' => [
							'required' => 'The publication title cannot be empty.',
							'alpha_numeric_space' => 'The publication title may only contain letters, numbers, and spaces.',
							'max_length' => 'The publication title cannot exceed 255 characters.',
						],
					],
					'pub.*.p_venue' => [
						'label' => 'Journal Name',
						'rules' => 'required|alpha_numeric_space|max_length[255]',
						'errors' => [
							'required' => 'The journal name cannot be empty.',
							'alpha_numeric_space' => 'The journal name may only contain letters, numbers, and spaces.',
							'max_length' => 'The journal name cannot exceed 255 characters.',
						],
					],
					'pub.*.afname' => [
						'label' => 'First Author',
						'rules' => 'required|alpha_numeric_punct|max_length[255]',
						'errors' => [
							'required' => 'The first author cannot be empty.',
							'alpha_numeric_punct' => 'The first author may only contain letters, numbers, and punctuation.',
							'max_length' => 'The first author cannot exceed 255 characters.',
						],
					],
					'pub.*.p_date' => [
						'label' => 'Publication Year',
						'rules' => 'required|numeric|exact_length[4]',
						'errors' => [
							'required' => 'The publication year cannot be empty.',
							'numeric' => 'The publication year must be a number.',
							'exact_length' => 'The publication year must be exactly 4 digits.',
						],
					],
					'pub.*.p_odi' => [
						'label' => 'DOI',
						'rules' => 'permit_empty|alpha_numeric_punct|max_length[255]',
						'errors' => [
							'alpha_numeric_punct' => 'The DOI may only contain letters, numbers, and punctuation.',
							'max_length' => 'The DOI cannot exceed 255 characters.',
						],
					],
				]);
				break;
		}
		if ($validation->withRequest($this->request)->run()) {
            $response['success'] = true;
        } else {
            $errors = $validation->getErrors();
			$formattedErrors = [];
			foreach ($errors as $key => $message) {
				if (preg_match('/^(pub|researcher)\.\d+\./', $key)) {
					$newKey = preg_replace('/\.(\d+)\./', '-$1-', $key);

				}else{
					$newKey = $key; 
				}
				$formattedErrors[$newKey] = $message;
			}
			$response['errors'] = $formattedErrors;
			
        }

        return $this->response->setJSON($response);
	}

    public function addDataset()
    {
        // Start a database transaction
        $this->db->transStart();

        // Step 1: Handle User Information
        $userEmail = filter_var($this->request->getPost('u_email'), FILTER_VALIDATE_EMAIL);
        $user = $this->userInfoModel->where('u_email', $userEmail)->first();

        if (!$user) {
            // Create a new user if not exists
            $u_id = $this->createNewUser();
            $accessCode = $this->generateNewToken($u_id);
        } else {
            $u_id = $user['u_id'];
            // Check for existing token or generate a new one if the token is older than three months
            $accessCode = $this->handleUserToken($u_id);
        }

		try {
			// Step 2: Prepare and insert dataset
			$datasetData = $this->prepareDatasetData($u_id);
			$d_id = $this->datasetModel->insertDataset($datasetData);


			if (!$d_id) {
				throw new \Exception('Failed to insert dataset'.json_encode($this->db->error()));
			}

			if(null !== $this->request->getPost('researcher')){
				// Step 3: Insert researchers
				$this->insertResearchers($d_id);
			}

            if(null !== $this->request->getPost('pub')){
				// Step 4: Insert publications
				$this->insertPublications($d_id);
			}

	
			// Step 5: Insert conditions
			$this->insertConditions($d_id);
	
			// Complete the transaction
			$this->db->transComplete();
			if ($this->db->transStatus() === false) {
				throw new \Exception('Transaction failed' . json_encode($this->db->error()));
			}
			// Send access link to the user
			$this->sendAccessLink($userEmail, $accessCode);
			$this->sendApprovalLink();

			return $this->response->setJSON(['success' => true, 'message' => 'Dataset added successfully, and access link sent to the user.']);
		} catch (\Exception $e) {
			log_message('error', 'Error in addDataset: ' . $e->getMessage());
			$this->db->transRollback();
			return $this->response->setJSON(['success' => false, 'message' => "Error".$e->getMessage()]);
		}

    }

	private function createNewUser()
	{
		$userData = [
			'u_fname' => filter_var($this->request->getPost('u_fname'), FILTER_SANITIZE_STRING),
			'u_lname' => filter_var($this->request->getPost('u_lname'), FILTER_SANITIZE_STRING),
			'u_email' => filter_var($this->request->getPost('u_email'), FILTER_VALIDATE_EMAIL),
			'u_role' => filter_var($this->request->getPost('u_role'), FILTER_SANITIZE_STRING)
		];
	
		log_message('debug', 'Inserting User Data: ' . json_encode($userData));
	
		if ($this->userInfoModel->insert($userData)) {
			return $this->userInfoModel->insertID();
		} else {
			log_message('error', 'Failed to insert user: ' . json_encode($this->db->error()));
			throw new \Exception('User insertion failed');
		}
	}

    private function handleUserToken($u_id)
    {
        $link = $this->linkModel->getToken($u_id);

        if ($link) {
            $tokenCreationDate = new \DateTime($link['created_at']);
            $currentDate = new \DateTime();
            $interval = $currentDate->diff($tokenCreationDate);

            if ($interval->m >= 3) {
                // Token is older than three months, generate a new one
                return $this->generateNewToken($u_id);
            }

            return $link['l_token'];
        }

        // No existing token, generate a new one
        return $this->generateNewToken($u_id);
    }

    private function generateNewToken($u_id)
    {
        return $this->linkModel->generateToken($u_id, null);
    }

    private function prepareDatasetData($u_id)
    {
        return [
            'u_id' => $u_id,
            'd_title' => filter_var($this->request->getPost('d_title'), FILTER_SANITIZE_STRING),
            'd_abstract' => filter_var($this->request->getPost('d_abstract'), FILTER_SANITIZE_STRING),
            'd_researchstudy' => filter_var($this->request->getPost('d_researchstudy'), FILTER_SANITIZE_STRING),
            'd_datatypes' => filter_var($this->request->getPost('d_datatypes'), FILTER_SANITIZE_STRING),
            'd_ethnicities' => filter_var($this->request->getPost('d_ethnicities'), FILTER_SANITIZE_STRING),
            'd_funders' => filter_var($this->request->getPost('d_funders'), FILTER_SANITIZE_STRING),
            'd_geographies' => filter_var($this->request->getPost('d_geographies'), FILTER_SANITIZE_STRING),
            'd_keywords' => filter_var($this->request->getPost('d_keywords'), FILTER_SANITIZE_STRING),
            'd_controler' => filter_var($this->request->getPost('d_controler'), FILTER_SANITIZE_STRING),
            'd_arights' => filter_var($this->request->getPost('d_arights'), FILTER_SANITIZE_URL),
            'd_legaljurisdiction' => filter_var($this->request->getPost('d_legaljurisdiction'), FILTER_SANITIZE_STRING),
            'd_organisation' => filter_var($this->request->getPost('d_organisation'), FILTER_SANITIZE_STRING),
            'd_conpoint' => filter_var($this->request->getPost('d_conpoint'), FILTER_VALIDATE_EMAIL),
            'd_hdrconsent' => filter_var($this->request->getPost('d_hdrconsent'), FILTER_SANITIZE_NUMBER_INT),
            'd_studysize' => filter_var($this->request->getPost('d_studysize'), FILTER_SANITIZE_NUMBER_INT),
            'd_uniqueid' => Uuid::uuid4()->toString()
        ];
    }

    private function insertResearchers($d_id)
    {

        $researchersData = array_map(function($item) use ($d_id) {
            return [
                'd_id' => $d_id,
                'p_title' => filter_var($item['title'], FILTER_SANITIZE_STRING),
                'p_firstname' => filter_var($item['forename'], FILTER_SANITIZE_STRING),
                'p_surname' => filter_var($item['surname'], FILTER_SANITIZE_STRING),
                'p_email' => filter_var($item['email'], FILTER_VALIDATE_EMAIL),
                'p_affiliations' => filter_var($item['affiliations'], FILTER_SANITIZE_STRING),
            ];
        }, $this->request->getPost('researcher'));

        $this->researcherModel->insertResearchers($researchersData);
    }

    private function insertPublications($d_id)
    {
        $publicationsData = array_map(function($item) use ($d_id) {
            return [
                'd_id' => $d_id,
                'pub_title' => filter_var($item['title'], FILTER_SANITIZE_STRING),
                'pub_venue' => filter_var($item['p_venue'], FILTER_SANITIZE_STRING),
                'pub_author' => filter_var($item['afname'], FILTER_SANITIZE_STRING),
                'pub_date' => filter_var($item['p_date'], FILTER_SANITIZE_NUMBER_INT),
                'pub_doi' => filter_var($item['p_odi'], FILTER_SANITIZE_STRING),
            ];
        }, $this->request->getPost('pub'));

        $this->publicationModel->insertPublications($publicationsData);
    }

    private function insertConditions($d_id)
    {
        $conditionsData = [
            'd_id' => $d_id,
            'c_countries' => filter_var($this->request->getPost('c_allowedcountries'), FILTER_SANITIZE_STRING),
            'c_profituse' => filter_var($this->request->getPost('c_profituse'), FILTER_SANITIZE_STRING),
            'c_broadresearchuse' => filter_var($this->request->getPost('c_bru'), FILTER_SANITIZE_STRING),
            'c_specificresearchuse' => filter_var($this->request->getPost('c_sru'), FILTER_SANITIZE_STRING),
            'c_reconenct' => filter_var($this->request->getPost('c_contact'), FILTER_SANITIZE_STRING),
        ];

        $this->conditionModel->insertCondition($conditionsData);
    }

    private function sendAccessLink($email, $accessCode)
    {
		$emailLib = new EmailLibrary();

		$accessLink = base_url("viewdata/index/{$accessCode}");
		$user = 'User';

        if (!$emailLib->sendAccessLink($email,$user,$accessLink)) {
            log_message('error', 'Failed to send access link email to user:');
        }

    }

	private function sendApprovalLink(){
		$emailLib = new EmailLibrary();

        if (!$emailLib->sendApprovalLink()) {
            log_message('error', 'Failed to send access link email to moderators: ');
        }

	}



}
