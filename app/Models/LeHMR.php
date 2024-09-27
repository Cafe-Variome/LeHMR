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
        'd_revisions', 'created_at', 'modified_at'
    ];

    public function insertDataset($data)
    {
        // Set default values
        $data['d_revisions'] = 0;
        $data['d_approved'] = 0;
        $data['d_rejected'] = 0;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['modified_at'] = date('Y-m-d H:i:s');
        $data['d_uniqueid'] = uniqid('ds_');

        $this->db->transStart();

        // Insert dataset and return the ID
        $this->insert($data['dataset']);
        $d_id = $this->insertID();

        // Insert associated researchers
        foreach ($data['researchers'] as $researcher) {
            $researcher['d_id'] = $d_id;
            $this->db->table('person')->insert($researcher);
        }

        // Insert associated publications
        foreach ($data['publications'] as $publication) {
            $publication['d_id'] = $d_id;
            $this->db->table('publications')->insert($publication);
        }

        // Insert associated conditions
        $conditions = $data['conditions'];
        $conditions['d_id'] = $d_id;
        $this->db->table('conditions')->insert($conditions);

        $this->db->transComplete();

        return $d_id;
    }

    public function updateDataset($d_id, $data)
    {
        $data['modified_at'] = date('Y-m-d H:i:s');
        $data['d_revisions'] = $this->db->table($this->table)
            ->where('d_id', $d_id)
            ->select('d_revisions')
            ->get()
            ->getRow()
            ->d_revisions + 1;

        $this->update($d_id, $data);
    }

    public function generateAccessCode($u_id, $d_id)
    {
        $token = bin2hex(random_bytes(16));
        $this->db->table('link')->insert([
            'u_id' => $u_id,
            'd_id' => $d_id,
            'l_token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $token;
    }
}
