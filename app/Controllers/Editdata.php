<?php

/**
 * LeHMR is a health metadata resource used to capture information regarding metadata to allow discovery.
 * This has been created by Brookeslab for which Prof Tony Brookes is the lead.
 * @author Umar Riaz
 * Created at 02/09/2024
 */

namespace App\Controllers;

use App\Models\LeHMRUpdateModel;
use App\Models\ConditionModel;
use CodeIgniter\Controller;
use Ramsey\Uuid\Uuid;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;


class Editdata extends BaseController
{

    protected $db;
    protected $encryption;


    public function __construct()
    {
        $this->encryption = Services::encrypter(); // Use CodeIgniter's encryption service
        $this->db = \Config\Database::connect(); // Initialize the database connection
    }


    public function index()
    {
        // Get the encrypted ID from the URL segment (assuming it's the 3rd segment)
        $encrypted_id = $this->request->uri->getSegment(2);
        // Check if $encrypted_id is provided
        if (is_null($encrypted_id)) {
            return redirect()->to('/error')->with('error', 'No dataset ID provided.');
        }
        // Decrypt the dataset ID
        $d_id = $this->decrypt($encrypted_id);
        if (!$d_id) {
            return redirect()->to('/error')->with('error', 'Invalid dataset ID.');
        }
        $LeHMRUpdateModel = new LeHMRUpdateModel();

        // Fetch the existing dataset, researchers, publications, and conditions
        $datasets = $LeHMRUpdateModel->getDatasetById($d_id);
        $researchers = $LeHMRUpdateModel->getResearchersByDatasetId($d_id);
        $publications = $LeHMRUpdateModel->getPublicationsByDatasetId($d_id);
        $conditions = $LeHMRUpdateModel->getConditionsByDatasetId($d_id);

        $dataFields = [
            'd_title' => 'Dataset Title',
            'd_abstract' => 'Abstract',
            'd_datatheme' => 'Data Theme',
            'd_funders' => 'Funders',
            'd_ethnicity' => 'Ethnicity',
            'd_datatypes' => 'Data Types',
            'd_keywords' => 'Keywords',
            'd_researchstudy' => 'Research Study',
            'd_geography' => 'Geography',
            'd_studysize' => 'Study Size',
            'd_agerange' => 'Age Range',
            'd_arights' => 'Access Rights',
            'd_organisation' => 'Organisation',
            'd_conpoint' => 'Contact Point',
            'd_legaljurisdiction' => 'Legal Jurisdiction',
            'd_controler' => 'Data Controller',
            'd_hdrconsent' => 'HDR Consent',
            'p_title' => 'Title',
            'p_firstname' => 'First Name',
            'p_surname' => 'Last Name',
            'p_email' => 'Email',
            'p_affiliations' => 'Affiliations',
            // Publications
            'pub_title' => 'Publication Title',
            'pub_venue' => 'Journal Name',
            'pub_date' => 'Publication Year',
            'pub_author' => 'First Author',
            'pub_doi' => 'DOI',
            // Conditions
            'c_countries' => 'Allowed Countries',
            'c_profituse' => 'Profit Use',
            'c_reconenct' => 'Recontact',
            'c_broadresearchuse' => 'Broad Research Uses',
            'c_specificresearchuse' => 'Specific Research Uses',

             
        ];

        $datasets['encrypted_id'] = $this->encrypt($datasets['d_id']);
       

        // Load the edit view with the fetched data
        return view('editdata/editdata', [
            'dataset' => $datasets,
            'dataFields' => $dataFields,
            'researchers' => $researchers,
            'publications' => $publications,
            'conditions' => $conditions
        ]);
    }

    public function updateDatasetSection($encrypted_id){

        // Ensure no previous output is present
        while (ob_get_level()) {ob_end_clean();}
        // Fetch the section from POST request
        $section = $this->request->getPost('section');
        // Decrypt the dataset ID
        $d_id = $this->decrypt($encrypted_id);
        if (!$d_id) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid dataset ID.']);
        }

        // Initialize Model
        $LeHMRUpdateModel = new LeHMRUpdateModel();

        // Fetch existing data for revision storage
        // $existingData = $LeHMRUpdateModel->getDatasetById($d_id);
        $oldValues = $this->getOldValues($d_id);

        $dataUpdate = false ;

        $revisionStored = false;


        // Start Database Transaction
        $this->db->transStart();

        $res = [];

        switch ($section) {
            case 'dataset':
                # code...
                $validationRules = $this->getDatasetValidationRules();
                $datasetdata = $this->sanitizeDatasetData($this->request->getPost());
                // Validate dataset data
                if (!$this->runValidation($validationRules, $datasetdata)) {
                    return $this->response->setJSON(['success' => false, 'errors' => $this->getValidationErrors()]);
                }
                // Update dataset in the database
                $dataUpdate=$LeHMRUpdateModel->updateDataset($d_id, $datasetdata);
                break;
            case 'researchers':
                $researchersData = $this->sanitizeResearchersData($this->request->getPost('researcher'));
                // Update researchers in the database
                try {
                    $researchersDataV = $this->request->getPost('researcher');

                    $validationRules = $this->getResearchersValidationRules();
                    $researcherValidation = $this->validatePublicationAndResearcher($validationRules, $researchersDataV['researcher']);

                    if (!$researcherValidation['success']) {
                        return $this->response->setJSON(['success' => false, 'errors' => $researcherValidation['errors'] , 'message' => 'Please fix following errors for Researcher '.$researcherValidation['entryNo']]);
                    }
                
           
                } catch (\Throwable $th) {
                    $res = ['success' => false, 'message' => $th->getMessage()] ;
                    log_message('error' , "Something Went Wrong!" . $th->getMessage());
                    return $this->response->setJSON($res);
                }
                try {
                    
                    $dataUpdate = $LeHMRUpdateModel->updateResearchers($d_id, $researchersData);
                } catch (\Throwable $th) {
                    //throw $th;
                    $res = ['success' => false, 'message' => $th->getMessage()] ;
                    return $this->response->setJSON($res);
                }
                
                break;
            case 'publications':
                $publicationsData = $this->sanitizePublicationsData($this->request->getPost('pub'));

                try {
                    $publicationsDataV = $this->request->getPost('pub');
                    $validationRules = $this->getPublicationsValidationRules();

                    $pubValidation = $this->validatePublicationAndResearcher($validationRules, $publicationsDataV['pubs']);
                    if (!$pubValidation['success']) {
                        return $this->response->setJSON(['success' => false, 'errors' => $pubValidation['errors'] , 'message' => 'Please fix following errors for Publication '.$pubValidation['entryNo']]);
                    }
               
                } catch (\Throwable $th) {
                    $res = ['success' => false, 'message' => 'Something Went Wrong'] ;
                    return $this->response->setJSON($res);
                }

                // Update publications in the database
                $dataUpdate =  $LeHMRUpdateModel->updatePublications($d_id, $publicationsData);
                break;

            case 'conditions':
                $validationRules = $this->getConditionsValidationRules();
                $conditionsData = $this->sanitizeConditionsData($this->request->getPost('condition'));
                // Validate conditions data
                if (!$this->runValidation($validationRules, $conditionsData)) {
                    return $this->response->setJSON(['success' => false, 'errors' => $this->getValidationErrors()]);
                }
                // Update conditions in the database
                $dataUpdate =  $LeHMRUpdateModel->updateConditions($d_id, $conditionsData);
                break;
            
            default:
                $res = ['success' => false, 'message' => 'Invalid section.'] ;
                return $this->response->setJSON($res);
                break;
        }

        if ($dataUpdate) {
            try {
                // Log success of data update
                log_message('info', "Data update succeeded");
                // Store the revision
                $revisionStored = $LeHMRUpdateModel->storeRevision($d_id, $oldValues);
        
            } catch (\Throwable $th) {
                log_message("Error in storeRevision: " . $th->getMessage());
                $res = ['success' => false, 'message' => $th->getMessage()];
                return $this->response->setJSON($res);
            }
        }
        
        $transactionComplete = $this->db->transComplete();
        log_message('info' , "Transaction complete: " . ($transactionComplete ? 'true' : 'false'));
        
        if ($dataUpdate && ($transactionComplete)) {
            // Success response
            $res = [
                'success' => true,
                'message' => ucfirst($section) . ' updated successfully',
            ];
        } else {
            // Failure response
            $res = [
                'success' => false,
                'message' => 'Failed to update ' . ucfirst($section),
            ];
            if (!$transactionComplete) {
                log_message('info' ,"Transaction failed.");
            }
            if (!$revisionStored) {
                log_message('info' , "Revision storage failed.");
            }
        }
        
        return $this->response->setJSON($res);
        

    }



    // Helper function to sanitize dataset data
    private function sanitizeDatasetData($postData)
    {
        return [
            'd_title' => isset($postData['d_title']) ? filter_var($postData['d_title'], FILTER_SANITIZE_STRING) : '', // Mandatory
            'd_abstract' => isset($postData['d_abstract']) ? filter_var($postData['d_abstract'], FILTER_SANITIZE_STRING) : '', // Mandatory
            'd_researchstudy' => isset($postData['d_researchstudy']) ? filter_var($postData['d_researchstudy'], FILTER_SANITIZE_STRING) : '', // Mandatory
            'd_agerange' => !empty($postData['d_agerange']) ? filter_var($postData['d_agerange'], FILTER_SANITIZE_STRING) : null, // Optional
            'd_studysize' => !empty($postData['d_studysize']) ? filter_var($postData['d_studysize'], FILTER_SANITIZE_STRING) : null, // Optional
            'd_theme' => !empty($postData['d_datatheme']) ? filter_var($postData['d_datatheme'], FILTER_SANITIZE_STRING) : null, // Optional
            'd_datatypes' => isset($postData['d_datatypes']) ? filter_var($postData['d_datatypes'], FILTER_SANITIZE_STRING) : '', // Mandatory
            'd_funders' => !empty($postData['d_funders']) ? filter_var($postData['d_funders'], FILTER_SANITIZE_STRING) : null, // Optional
            'd_ethnicities' => !empty($postData['d_ethnicity']) ? filter_var($postData['d_ethnicity'], FILTER_SANITIZE_STRING) : null, // Optional
            'd_geographies' => !empty($postData['d_geography']) ? filter_var($postData['d_geography'], FILTER_SANITIZE_STRING) : null, // Optional
            'd_keywords' => isset($postData['d_keywords']) ? filter_var($postData['d_keywords'], FILTER_SANITIZE_STRING) : '', // Mandatory
            'd_controler' => isset($postData['d_controler']) ? filter_var($postData['d_controler'], FILTER_SANITIZE_STRING) : '', // Mandatory
            'd_arights' => isset($postData['d_arights']) ? filter_var($postData['d_arights'], FILTER_SANITIZE_URL) : '', // Mandatory
            'd_legaljurisdiction' => isset($postData['d_legaljurisdiction']) ? filter_var($postData['d_legaljurisdiction'], FILTER_SANITIZE_STRING) : '', // Mandatory
            'd_organisation' => isset($postData['d_organisation']) ? filter_var($postData['d_organisation'], FILTER_SANITIZE_STRING) : '', // Mandatory
            'd_conpoint' => isset($postData['d_conpoint']) ? filter_var($postData['d_conpoint'], FILTER_SANITIZE_EMAIL) : '', // Mandatory
            'd_hdrconsent' => isset($postData['d_hdrconsent']) ? filter_var($postData['d_hdrconsent'], FILTER_SANITIZE_STRING) : '' // Mandatory
        ];
    }
    

    // Helper function to sanitize researcher data
    private function sanitizeResearchersData($researchers)
    {
        return array_map(function ($item) {
            return [
                'p_title' => filter_var($item['title'], FILTER_SANITIZE_STRING),
                'p_firstname' => filter_var($item['firstname'], FILTER_SANITIZE_STRING),
                'p_surname' => filter_var($item['surname'], FILTER_SANITIZE_STRING),
                'p_email' => filter_var($item['email'], FILTER_VALIDATE_EMAIL),
                'p_affiliations' => $item['affiliations'],
            ];
        }, $researchers["researcher"]);
    }

    // Helper function to sanitize publications data
    private function sanitizePublicationsData($publications)
    {
        if (!is_array($publications["pubs"]) || empty($publications["pubs"])) {
            return [];  // Return an empty array or handle the case where no publications data is provided
        }
    
        return array_map(function ($item) {
            return [
                'pub_title' => filter_var($item['title'], FILTER_SANITIZE_STRING),
                'pub_venue' => filter_var($item['p_venue'], FILTER_SANITIZE_STRING),
                'pub_date' => filter_var($item['p_date'], FILTER_SANITIZE_STRING),
                'pub_author' => filter_var($item['afname'], FILTER_SANITIZE_STRING),
                'pub_doi' => filter_var($item['p_odi'], FILTER_SANITIZE_STRING),
            ];
        }, $publications["pubs"]);
    }

    // Helper function to sanitize conditions data
    private function sanitizeConditionsData($postData)
    {
        return [
            'c_countries' => !empty($postData['c_allowedcountries']) ? filter_var($postData['c_allowedcountries'], FILTER_SANITIZE_STRING) : '',
            'c_profituse' => !empty($postData['c_profituse']) ? filter_var($postData['c_profituse'], FILTER_SANITIZE_STRING) : '',
            'c_broadresearchuse' => !empty($postData['c_bru']) ? filter_var($postData['c_bru'], FILTER_SANITIZE_STRING) : '',
            'c_specificresearchuse' => !empty($postData['c_sru']) ? filter_var($postData['c_sru'], FILTER_SANITIZE_STRING) : '',
            'c_reconenct' => !empty($postData['c_recontact']) ? filter_var($postData['c_recontact'], FILTER_SANITIZE_STRING) : '',
        ];
    }
    

    // Helper function to validate data with rules
    protected function runValidation($validationRules, $data)
    {
        $validation = \Config\Services::validation();
        $validation->setRules($validationRules);

        return $validation->withRequest($this->request)->run($data);
    }

    // Helper function to get validation errors
    protected function getValidationErrors()
    {
        $validation = \Config\Services::validation();

        try {
            //code...
            return $validation->getErrors();
        } catch (\Throwable $th) {
            log_message("Error in storeRevision: " . $th->getMessage());

        }
        
    }



    



    private function getDatasetValidationRules()
    {
        return [
            'd_title' => [
                'label' => 'Title',
                'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]|max_length[500]',
                'errors' => [
                    'required' => 'The dataset title cannot be empty.',
                    'regex_match' => 'The dataset title may only contain letters, numbers, spaces, semicolons, periods, and commas.',
                    'max_length' => 'The dataset title cannot exceed 200 characters.'
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
        ];
    }

    private function getResearchersValidationRules()
    {
        return [
                'title' => [
                    'label' => 'Title',
                    'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
                    'errors' => [
                        'regex_match' => 'The title may only contain letters, numbers, spaces, semicolons, periods, and commas.',
                    ],
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'The email address is required.',
                        'valid_email' => 'Please provide a valid email address.',
                    ],
                ],
                'firstname' => [
                    'label' => 'Forename',
                    'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
                    'errors' => [
                        'required' => 'The forename is required.',
                        'regex_match' => 'The forename may only contain letters, numbers, spaces, semicolons, periods, and commas.',
                    ],
                ],
                'surname' => [
                    'label' => 'Surname',
                    'rules' => 'required|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
                    'errors' => [
                        'required' => 'The surname is required.',
                        'regex_match' => 'The surname may only contain letters, numbers, spaces, semicolons, periods, and commas.',
                    ],
                ],
                'affiliations' => [
                    'label' => 'Affiliations',
                    'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9\s;.,:]+$/]',
                    'errors' => [
                        'regex_match' => 'The affiliations may only contain letters, numbers, spaces, semicolons, periods, and commas.',
                    ],
                ],
        ];
    }

    private function getConditionsValidationRules()
    {
        return [
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
        ];
    }

    private function getPublicationsValidationRules()
    {
        return [
            'title' => [
                'label' => 'Publication Title',
                'rules' => 'required|alpha_numeric_space|max_length[255]',
                'errors' => [
                    'required' => 'The publication title cannot be empty.',
                    'alpha_numeric_space' => 'The publication title may only contain letters, numbers, and spaces.',
                    'max_length' => 'The publication title cannot exceed 255 characters.',
                ],
            ],
            'p_venue' => [
                'label' => 'Journal Name',
                'rules' => 'required|alpha_numeric_space|max_length[255]',
                'errors' => [
                    'required' => 'The journal name cannot be empty.',
                    'alpha_numeric_space' => 'The journal name may only contain letters, numbers, and spaces.',
                    'max_length' => 'The journal name cannot exceed 255 characters.',
                ],
            ],
            'afname' => [
                'label' => 'First Author',
                'rules' => 'required|alpha_numeric_punct|max_length[255]',
                'errors' => [
                    'required' => 'The first author cannot be empty.',
                    'alpha_numeric_punct' => 'The first author may only contain letters, numbers, and punctuation.',
                    'max_length' => 'The first author cannot exceed 255 characters.',
                ],
            ],
            'p_date' => [
                'label' => 'Publication Year',
                'rules' => 'required|numeric|exact_length[4]',
                'errors' => [
                    'required' => 'The publication year cannot be empty.',
                    'numeric' => 'The publication year must be a number.',
                    'exact_length' => 'The publication year must be exactly 4 digits.',
                ],
            ],
            'p_odi' => [
                'label' => 'DOI',
                'rules' => 'permit_empty|alpha_numeric_punct|max_length[255]',
                'errors' => [
                    'alpha_numeric_punct' => 'The DOI may only contain letters, numbers, and punctuation.',
                    'max_length' => 'The DOI cannot exceed 255 characters.',
                ],
            ],
            // Add other publication validation rules similarly...
        ];
    }

    private function formatErrors($errors)
    {
        $formattedErrors = [];
        foreach ($errors as $key => $message) {
            if (preg_match('/^(pub|researcher)\.\d+\./', $key)) {
                $newKey = preg_replace('/\.(\d+)\./', '-$1-', $key);
            } else {
                $newKey = $key;
            }
            $formattedErrors[$newKey] = $message;
        }
        return $formattedErrors;
    }


    private function validatePublicationAndResearcher($rules,$data){
        
        $validation = \Config\Services::validation();
        $validation->setRules($rules);
        $valid = true;

        
        foreach ($data as $key => $d) {
            if (!$validation->run($d)) {
                // If validation fails, return errors
                return [
                    'success' => false,
                    'errors' => $validation->getErrors(),
                    'entryNo' => $key + 1 
                ];
            }else{
                $valid = true;
            }
        }
        if($valid){

            return [
                'success' => true,
                'errors' => []
            ];
        }
    }


    private function decrypt($data)
    {

        return $this->encryption->decrypt(hex2bin($data));
    }

    private function encrypt($data)
    {
        return bin2hex($this->encryption->encrypt($data));
    }

    private function getOldValues($id){
        
        $oldValues =[];
        $LeHMRUpdateModel = new LeHMRUpdateModel();
        $dataset = $LeHMRUpdateModel->getDatasetById($id);
        $researchers = $LeHMRUpdateModel->getResearchersByDatasetId($id);
        $Publications = $LeHMRUpdateModel->getPublicationsByDatasetId($id);
        $Conditions = $LeHMRUpdateModel->getConditionsByDatasetId($id);
        $oldValues =[
            'dataset' => $dataset,
            'researchers' => $researchers,
            'publications' => $Publications,
            'conditions' => $Conditions,
        ];
        return json_encode($oldValues);
    }
    




}
