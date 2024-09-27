<?php

namespace App\Models;

use CodeIgniter\Model;

class PublicationModel extends Model
{
    protected $table = 'publications';
    protected $primaryKey = 'pub_id';
    protected $allowedFields = [
        'd_id', 'pub_title', 'pub_venue', 'pub_author', 'pub_date', 'pub_doi','archived'
    ];

    public function insertPublications($publications)
    {
        foreach ($publications as $publication) {
            $this->insert($publication);
        }
    }
}
