<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'Id_transaksi';
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
    protected $returnType = 'object';
    protected $allowedFields = ['Id_pesanan', 'id_user', 'akun_bank', 'bukti'];

    public function GetTransaksi($Id_transaksi = false)
    {
        if ($Id_transaksi == false) {
            return $this->findAll();
        }

        return $this->where(['Id_transaksi' => $Id_transaksi])->first();
    }

    public function hapus($Id_transaksi)
    {
        $builder = $this->db->table('transaksi');
        $builder->where('Id_transaksi', $Id_transaksi);
        $builder->delete();
    }
}
