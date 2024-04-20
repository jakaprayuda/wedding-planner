<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use App\Models\PaketModel;
use CodeIgniter\HTTP\Request;
use Config\Validation;
use \Dompdf\Dompdf;

class C_admin extends BaseController
{
    protected $PesananModel;
    protected $UserModel;
    protected $TransaksiModel;
    protected $PaketModel;
    public function __construct()
    {
        $this->PesananModel = new PesananModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->UserModel = new UserModel();
        $this->PaketModel = new PaketModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_user') ? $currentpage = $this->request->getVar('page_user') : 1;

        // d($this->request->getVar('keyword'));
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $user = $this->UserModel->search($keyword);
        } else {
            $user = $this->UserModel;
        }

        $data = [
            'title' => 'Home | Admin',
            'konfirmasi' => $this->PesananModel->getStatus(),
            'pesanan' => $this->PesananModel->listPesanan(),
            'paket' => $this->PaketModel->listPaket(),
            'listUser' => $this->UserModel->listUser(),
            //'user' => $this->UserModel->add_user()
            'user' => $user->paginate(5, 'user'),
            'pager' => $this->UserModel->pager,
            'currentPage' => $currentPage
        ];

        return view('admin/home_admin', $data);
    }

    public function konfirm_pesanan()
    {
        $data = [
            'title' => 'Konfirmasi Pesanan',
            'validation' => \config\Services::validation(),
            'Pesanan' => $this->PesananModel->getKonfirmasi()
        ];

        return view('admin/konfirmasi', $data);
    }

    public function pesanan()
    {

        $keyword = '';
        if ($this->request->getPost()) {
            $keyword = $this->request->getPost('keyword');
        }
        $total = $this->PesananModel->getsum();

        $data = [
            'title' => 'Daftar Pesanan',
            'validation' => \config\Services::validation(),
            'pesanan' => $this->PesananModel->getjoin($keyword),
            'total' => $total,
            'keyword' => $keyword
        ];

        // var_dump(json_encode($data));
        // die();
        return view('admin/V_pesanan', $data);
    }

    public function cetakAll()
    {
        $total = $this->PesananModel->getsum();
        $data = [
            'validation' => \config\Services::validation(),
            'Pesanan' => $this->PesananModel->join(),
            'total' => $total
        ];
        $html = view('admin/cetak_PDF', $data);
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Dokumen Pesanan.pdf", array("Attachment" => false));
    }

    public function detail($Id_pesanan)
    {
        $pesanan = $this->PesananModel->find($Id_pesanan);
        // var_dump(json_encode($query));
        // die();

        $data = [
            'title' => 'Detail Pesanan',
            'paket' => $this->PaketModel->find($pesanan->id_paket),
            'pesanan' => $pesanan
        ];
        return view('admin/detail_pesanan', $data);
    }

    public function cetakID($Id_pesanan)
    {
        $pesanan = $this->PesananModel->find($Id_pesanan);
        $data = [
            'paket' => $this->PaketModel->find($pesanan->id_paket),
            'pesanan' => $pesanan
        ];

        $html = view('admin/cetak_id', $data);
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Dokumen ID.pdf", array("Attachment" => false));
    }

    public function konfirmasi()
    {
        if (!$this->validate([
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' =>  'isi status.'
                ]
            ]
        ])) {
            return redirect()->to('/C_admin/konfirm_pesanan')->withInput();
        }
        $Id_pesanan = $this->request->getVar('id_pesanan');

        $this->PesananModel->save([
            'Id_pesanan' => $Id_pesanan,
            'status' => $this->request->getvar('status')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/C_admin/konfirm_pesanan');
    }

    public function delete_konfirmasi()
    {

        $Id_pesanan = $this->request->getVar('id_pesanan');
        $Id_transaksi = $this->request->getVar('id_transaksi');

        $this->PesananModel->hapus($Id_pesanan);
        $this->TransaksiModel->hapus($Id_transaksi);
        session()->setFlashdata('pesan', 'Pesanan Dibatalkan.');
        return redirect()->to('/C_admin/konfirm_pesanan');
    }

    public function delete_pesanan()
    {

        $Id_pesanan = $this->request->getVar('id_pesanan');
        $Id_transaksi = $this->request->getVar('id_transaksi');

        $this->PesananModel->hapus($Id_pesanan);
        $this->TransaksiModel->hapus($Id_transaksi);
        session()->setFlashdata('pesan', 'Data Pesanan Dihapus.');
        return redirect()->to('/C_admin/pesanan');
    }

    public function user()
    {
        $data = [
            'title' => 'Data User',
            'user' => $this->UserModel->add_user()
        ];

        return view('admin/user', $data);
    }

    public function delete_user($id_user)
    {

        $this->UserModel->delete($id_user);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/C_admin/user');
    }

    public function paket()
    {
        session();
        $data = [
            'title' => 'Data Paket',
            'validation' => \config\Services::validation(),
            'paket' => $this->PaketModel->getPaket()
        ];

        return view('admin/paket', $data);
    }

    public function insert_paket()
    {
        // buat validasi inputan
        if (!$this->validate([
            'plh_paket' => [
                'rules' => 'required|is_unique[paket.plh_paket]',
                'errors' => [
                    'required' =>  'Nama Harus diisi.',
                    'is_unique' => 'Nama sudah terdaftar.'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'pilih gambar terlebih dahulu',
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \config\Services::validation();
            //return redirect()->to('/C_admin/paket')->withInput()->with('validation', $validation);
            session()->setFlashdata('pesan1', 'Data gagal di simpan.');
            return redirect()->to('/C_admin/paket')->withInput();
        }

        // ambil gambar ke folder
        $filegambar = $this->request->getFile('gambar');

        //generate nama gambar random
        $namagambar = $filegambar->getRandomName();

        // save gambar ke folder
        $filegambar->move('img/paket', $namagambar);

        $harga = $this->request->getVar('harga');
        $dp = $harga * 25 / 100;

        //ambil nama file
        //$namagambar = $filegambar->getName();

        $this->PaketModel->save([
            'plh_paket' => $this->request->getvar('plh_paket'),
            'harga' => $harga,
            'gambar' => $namagambar,
            'DP' => $dp
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/C_admin/paket');
        //dd($this->request->getVar());

    }

    public function delete_paket($id_paket)
    {
        // cari gambar berdasarkan id
        $paket = $this->PaketModel->find($id_paket);

        // hapus gambar pada folder
        unlink('img/paket/' . $paket->gambar);

        $this->PaketModel->delete($id_paket);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/C_admin/paket');
    }

    public function edit_paket($id_paket)
    {
        $paket = $this->PaketModel->find($id_paket);

        $data = [
            'title' => 'Update Paket',
            'validation' => \config\Services::validation(),
            'paket' => $paket
        ];
        return view('admin/update_paket', $data);
    }

    public function update_paket($id_paket)
    {
        //dd($this->request->getVar());

        // //cek nama paket
        // $paketLama = $this->PaketModel->getPaket($this->request->getVar('id_paket'));
        // if ($paketLama['plh_paket'] == $this->request->getVar('plh_paket')) {
        //     $rule_paket = 'required';
        // } else {
        //     $rule_paket = 'required|is_unique[paket.plh_paket]';
        // }

        // buat validasi inputan
        if (!$this->validate([
            'plh_paket' => [
                // 'rules' => $rule_paket,
                'rules' => 'required',
                'errors' => [
                    'required' =>  'Nama Harus diisi.'
                    // 'is_unique' => 'Nama sudah terdaftar.'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {

            return redirect()->to('/C_admin/edit_paket')->withInput();
        }

        $filegambar = $this->request->getFile('gambar');

        // cek gambar, apakah gambar lama
        if ($filegambar->getError() == 4) {
            $namagambar = $this->request->getvar('gambarLama');
        } else {
            //generate nama gambar random
            $namagambar = $filegambar->getRandomName();

            // save gambar ke folder
            $filegambar->move('img/paket', $namagambar);

            //hapus gambar lama
            unlink('img/paket/' . $this->request->getVar('gambarLama'));
        }

        $this->PaketModel->save([
            'id_paket' => $id_paket,
            'plh_paket' => $this->request->getvar('plh_paket'),
            'harga' => $this->request->getvar('harga'),
            'gambar' => $namagambar
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/C_admin/paket');
    }
}
