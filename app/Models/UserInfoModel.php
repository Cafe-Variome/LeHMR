<?php

namespace App\Models;

use CodeIgniter\Model;

class UserInfoModel extends Model
{
    protected $table = 'userinfo';
    protected $primaryKey = 'u_id';
    protected $allowedFields = ['u_fname', 'u_lname', 'u_email', 'u_role','archived'];

    public function insertUser($userData)
    {
        $sql = "INSERT INTO userinfo (u_fname, u_lname, u_email, u_role) VALUES (:u_fname:, :u_lname:, :u_email:, :u_role:)";
        $query = $this->db->query($sql, $userData);

        if ($query) {
            return $this->db->insertID();
        } else {
            log_message('error', 'Insert User Failed: ' . json_encode($this->db->error()));
            return false;
        }
    }

        // Method to find user by first name, last name, and email
        public function findUser($fname, $lname, $email)
        {
            return $this->where('u_fname', $fname)
                        ->where('u_lname', $lname)
                        ->where('u_email', $email)
                        ->first();
        }
}
