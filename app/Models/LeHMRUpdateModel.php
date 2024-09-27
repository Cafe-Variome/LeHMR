<?php

namespace App\Models;

use CodeIgniter\Model;

class LeHMRUpdateModel extends Model
{
    protected $table = 'dataset';
    protected $primaryKey = 'd_id';
    protected $allowedFields = [
        'd_title', 'd_abstract', 'd_theme', 'd_researchstudy', 'd_datatypes', 'd_ethnicities',
        'd_funders', 'd_geographies', 'd_keywords', 'd_agerange', 'd_studysize', 'd_controler',
        'd_arights', 'd_legaljurisdiction', 'd_organisation', 'd_conpoint', 'd_hdrconsent',
        'd_revisions', 'modified_at'
    ];

    public function getDatasetById($d_id)
    {
        return $this->db->table('dataset')->where('d_id', $d_id)->get()->getRowArray();
    }

    public function getResearchersByDatasetId($d_id)
    {
        return $this->db->table('person')->where('d_id', $d_id)->get()->getResultArray();
    }

    public function getPublicationsByDatasetId($d_id)
    {
        return $this->db->table('publications')->where('d_id', $d_id)->get()->getResultArray();
    }

    public function getConditionsByDatasetId($d_id)
    {
        return $this->db->table('conditions')->where('d_id', $d_id)->get()->getRowArray();
    }

    public function updateDataset($d_id, $data)
    {
        return $this->db->table('dataset')->where('d_id', $d_id)->update($data);
    }

    public function updateResearchers($d_id, $researchersData)
    {
        // Remove existing researchers
        $this->db->table('person')->where('d_id', $d_id)->delete();

        $toReturn = false;

        // Add updated researchers
        foreach ($researchersData as $researcher) {
            $researcher['d_id'] = $d_id;
            $toReturn = $this->db->table('person')->insert($researcher);
        }

        return $toReturn;
    }

    public function updatePublications($d_id, $publicationsData)
    {
        // Remove existing publications
        $this->db->table('publications')->where('d_id', $d_id)->delete();

        $toReturn = false;

        // Add updated publications
        foreach ($publicationsData as $publication) {
            $publication['d_id'] = $d_id;
            $toReturn = $this->db->table('publications')->insert($publication);
        }

        return $toReturn;
    }

    public function updateConditions($d_id, $conditionsData)
    {
        return $this->db->table('conditions')->where('d_id', $d_id)->update($conditionsData);
    }

    public function incrementRevision($d_id)
    {
        return $this->db->table('dataset')
            ->where('d_id', $d_id)
            ->set('d_revisions', 'd_revisions+1', false)
            ->set('modified_at', 'NOW()', false)
            ->update();
    }

    public function storeRevision($d_id, $oldValues)
    {
        $data = [
            'd_id' => $d_id,
            'r_no' => $this->db->table('revisions')->where('d_id', $d_id)->countAllResults() + 1,
            'old_values' => $oldValues,
            'modified_at' => date('Y-m-d H:i:s')
        ];
        try {
            //code...
            log_message('info', 'I am heere');
           return $this->db->table('revisions')->insert($data);
        } catch (\Throwable $th) {
            //throw $th;
            log_message('error', 'Reason: ' . $th->getMessage());
        }
       
    }
}

