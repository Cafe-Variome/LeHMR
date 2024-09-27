<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table = 'link';
    protected $primaryKey = 'l_id';
    protected $allowedFields = ['u_id', 'l_token', 'created_at'];

    public function generateToken($u_id, $d_id)
    {
        $token = bin2hex(random_bytes(16));
        $data = [
            'u_id' => $u_id,
            'l_token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->insert($data);

        return $token;

    }

    public function getToken($u_id)
    {
        return $this->where('u_id', $u_id)->orderBy('created_at', 'DESC')->first();
    }
}
