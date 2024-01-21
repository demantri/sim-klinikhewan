<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function __construct() { //memanggil 
        $this->db = db_connect();
    }

    public function getUser($post)
    {
        $sql = "select * from users ";
        if (substr_count($post, '@') > 0) {
            // this is email
            $sql .= "where email = '$post'";
        } else {
            // this is username
            $sql .= "where username = '$post'";
        }

        $data = $this->db->query($sql)->getRow();
        
        return $data;
    }
}
