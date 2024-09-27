<?php

namespace App\Models;

use CodeIgniter\Model;

class ResearcherModel extends Model
{
    protected $table = 'person';
    protected $primaryKey = 'p_id';
    protected $allowedFields = [
        'd_id', 'p_title', 'p_firstname', 'p_surname', 'p_email', 'p_affiliations','archived'
    ];

    public function insertResearchers($researchers)
    {
        foreach ($researchers as $researcher) {
            $this->insert($researcher);
        }
    }
}
