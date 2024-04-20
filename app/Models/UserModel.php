<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama_user', 'username', 'password', 'Level'];

    public function add_user($id_user = false)
    {
        if ($id_user == false) {
            return $this->findAll();
        }

        return $this->where(['id_user' => $id_user])->first();
    }

    public function listUser()
    {
        $builder = $this->db->table('user');

        return $builder->countAllResults();
    }

    public function search($keyword)
    {
        return $this->table('user')->like('nama_user', $keyword)->orLike('Level', $keyword);
    }
}
