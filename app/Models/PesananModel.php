<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'Id_pesanan';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_user', 'id_paket', 'Nama', 'tgl_booking', 'Telepon', 'Alamat', 'status'];

    public function getPesanan($Id_pesanan = false)
    {
        if ($Id_pesanan == false) {
            return $this->findAll();
        }

        return $this->where(['Id_pesanan' => $Id_pesanan])->first();
    }

    public function getjoin($keyword)
    {
        $builder = $this->db->table('pesanan');
        $builder->join('transaksi', 'transaksi.Id_pesanan = pesanan.Id_pesanan');
        $builder->join('paket', 'paket.id_paket = pesanan.id_paket');
        $builder->where('status', 2);
        $builder->like('pesanan.Nama', $keyword)->orLike('tgl_booking', $keyword);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getsum()
    {
        $builder = $this->db->table('pesanan');
        $builder->join('paket', 'paket.id_paket = pesanan.id_paket');
        $builder->where('status', 2);
        $builder->selectSum('DP', 'total_bayar');
        $query = $builder->get();
        return $query->getResult();
    }

    public function join()
    {
        $builder = $this->db->table('pesanan');
        $builder->join('transaksi', 'transaksi.Id_pesanan = pesanan.Id_pesanan');
        $builder->join('paket', 'paket.id_paket = pesanan.id_paket');
        $builder->where('status', 2);
        $builder->orderBy('Id_transaksi', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getKonfirmasi()
    {
        $builder = $this->db->table('pesanan');
        $builder->join('transaksi', 'transaksi.Id_pesanan = pesanan.Id_pesanan');
        $builder->join('paket', 'paket.id_paket = pesanan.id_paket');
        $builder->where('status', 1);
        $builder->orderBy('Id_transaksi', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getOrder($id_user)
    {
        $builder = $this->db->table('pesanan');
        $builder->join('transaksi', 'transaksi.Id_pesanan = pesanan.Id_pesanan');
        $builder->join('paket', 'paket.id_paket = pesanan.id_paket');
        $builder->orderBy('Id_transaksi', 'DESC');
        $builder->where('pesanan.id_user', $id_user);
        $query = $builder->get();
        return $query->getResult();
    }

    public function hapus($Id_pesanan)
    {
        $builder = $this->db->table('pesanan');
        $builder->where('Id_pesanan', $Id_pesanan);
        $builder->delete();
    }

    public function getStatus()
    {
        $builder = $this->db->table('pesanan');
        $builder->select('*');
        $builder->where('status', 1);

        return $builder->countAllResults();
    }

    public function listPesanan()
    {
        $builder = $this->db->table('pesanan');
        $builder->select('*');
        $builder->where('status', 2);

        return $builder->countAllResults();
    }

    public function search($keyword)
    {
        return $this->table('pesanan')->like('Nama', $keyword)->orLike('tgl_booking', $keyword);
    }

    function add($data)
    {
        return $this->db
            ->table('pesanan')
            ->insert($data);
    }
}
