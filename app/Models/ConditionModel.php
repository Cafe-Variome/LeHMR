<?php

namespace App\Models;

use CodeIgniter\Model;

class ConditionModel extends Model
{
    protected $table = 'conditions';
    protected $primaryKey = 'c_id';
    protected $allowedFields = [
        'd_id', 'c_countries', 'c_profituse', 'c_broadresearchuse', 'c_specificresearchuse', 'c_reconenct','archived'
    ];

    public function insertCondition($conditionData)
    {
        $this->insert($conditionData);
    }
}
