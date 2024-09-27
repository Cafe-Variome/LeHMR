<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetModel extends Model
{
    protected $table = 'dataset';
    protected $primaryKey = 'd_id';
    protected $allowedFields = [
        'u_id', 'd_uniqueid', 'd_title', 'd_abstract', 'd_theme', 'd_researchstudy', 
        'd_datatypes', 'd_ethnicities', 'd_funders', 'd_geographies', 'd_keywords', 
        'd_agerange', 'd_studysize', 'd_controler', 'd_arights', 'd_legaljurisdiction', 
        'd_organisation', 'd_conpoint', 'd_approved', 'd_rejected', 'd_hdrconsent', 
        'd_revisions', 'created_at', 'modified_at','archived'
    ];
    public function getDatasetWithDetails($id)
    {
        $dataset = $this->find($id);

        if ($dataset) {
            $dataset['researchers'] = $this->db->table('person')
                                               ->where('d_id', $id)
                                               ->get()->getResultArray();

            $dataset['publications'] = $this->db->table('publications')
                                                ->where('d_id', $id)
                                                ->get()->getResultArray();

            $dataset['conditions'] = $this->db->table('conditions')
                                              ->where('d_id', $id)
                                              ->get()->getRowArray();

            return $dataset;
        } else {
            return null;
        }
    }

    public function insertDataset($datasetData)
    {
        $datasetData['d_revisions'] = 0;
        $datasetData['d_approved'] = 0;
        $datasetData['d_rejected'] = 0;
        $datasetData['created_at'] = date('Y-m-d H:i:s');
        $datasetData['modified_at'] = date('Y-m-d H:i:s');
        // $datasetData['d_uniqueid'] = \Ramsey\Uuid\Uuid::uuid4()->toString();

        // Insert dataset and return the ID
        $this->insert($datasetData);
        return $this->insertID();
    }

    public function updateDataset($d_id, $datasetData)
    {
        $datasetData['modified_at'] = date('Y-m-d H:i:s');
        $datasetData['d_revisions'] = $this->db->table($this->table)
            ->where('d_id', $d_id)
            ->select('d_revisions')
            ->get()
            ->getRow()
            ->d_revisions + 1;

        $this->update($d_id, $datasetData);
    }

    public function generateAccessCode($u_id)
    {
        $token = bin2hex(random_bytes(16));
        $this->db->table('link')->insert([
            'u_id' => $u_id,
            'l_token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $token;
    }
}
