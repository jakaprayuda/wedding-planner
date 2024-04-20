<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $table = 'paket';
    protected $primaryKey = 'id_paket';
    protected $returnType = 'object';
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
    protected $allowedFields = ['plh_paket', 'harga', 'gambar', 'DP'];

    public function getPaket($id_paket = false)
    {
        if ($id_paket == false) {
            return $this->findAll();
        }

        return $this->where(['id_paket' => $id_paket])->first();
    }

    public function listPaket()
    {
        $builder = $this->db->table('paket');

        return $builder->countAllResults();
    }
}
