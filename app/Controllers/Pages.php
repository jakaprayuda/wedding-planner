<?php

namespace App\Controllers;

use \App\Models\PesananModel;
use \App\Models\UserModel;
use \App\Models\TransaksiModel;
use \App\Models\PaketModel;
use CodeIgniter\HTTP\Request;
use Config\Validation;
use \Dompdf\Dompdf;
use phpDocumentor\Reflection\Types\Null_;

use function PHPUnit\Framework\isNull;

class Pages extends BaseController
{
    protected $PesananModel;
    protected $UserModel;
    protected $TransaksiModel;
    protected $PaketModel;
    public function __construct()
    {

        $this->PesananModel = new PesananModel();
        $this->UserModel = new UserModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->PaketModel = new PaketModel();
    }

    public function index()
    {
        session();
        $data = [
            'title' => 'Home | Syarif Wedding Project'
        ];

        return view('pages/Home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About SWP'
        ];

        return view('pages/About', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact SWP'
        ];

        return view('pages/Contact', $data);
    }

    public function package()
    {
        $data = [
            'title' => 'Package SWP',
            'paket' => $this->PaketModel->getPaket()
        ];

        return view('pages/Package', $data);
    }

    public function booking()
    {
        $session = session();
        if ($session->has('nama_user') == null) {
            return redirect()->to('C_login');
        }

        $data = [
            'title' => 'Form Booking',
            'user'  => $this->UserModel->where(['id_user' => session()->get('id_user')])->first(),
            'pesanan' => $this->PesananModel->where(['id_user' => session()->get('id_user')])->first(),
            'validation' => \config\Services::validation(),
            'paket' => $this->PaketModel->getPaket()
        ];

        return view('pages/Form_pesan', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|min_length[2]|max_length[15]',
                'errors' => [
                    'required' =>  'Nama Harus diisi.',
                    'min_length' => 'Karakter Nama Kurang',
                    'max_length' => 'Karakter Nama Lebih.'
                ]
            ],
            'paket' => [
                'rules' => 'required',
                'errors' => [
                    'required' =>  'Pilih Paket.'
                ]
            ],
            'date' => [
                'rules' => 'required',
                'errors' => [
                    'required' =>  'Pilih Tanggal.'
                ]
            ],
            'phone' => [
                'rules' => 'required|min_length[10]|max_length[13]',
                'errors' => [
                    'required' =>  'Isi Nomor telepon.',
                    'min_length' => 'Karakter nomer Kurang',
                    'max_length' => 'Karakter nomer Lebih.'
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[5]|max_length[100]',
                'errors' => [
                    'required' =>  'Isi Alamat.',
                    'min_length' => 'Karakter Alamat Kurang',
                    'max_length' => 'Karakter Alamat Lebih.'
                ]
            ]
        ])) {

            return redirect()->to('/Pages/booking')->withInput();
        }

        $data = $this->UserModel->where(['id_user' => session()->get('id_user')])->first();
        $pesanan = $this->PesananModel->where(['id_user' => session()->get('id_user')])->find();
        $tgl_booking = $this->request->getVar('date');

        $pesanan = [
            'id_user' => $data->id_user,
            'Nama' => $this->request->getvar('nama'),
            'id_paket' => $this->request->getVar('paket'),
            'tgl_booking' => $tgl_booking,
            'Telepon' => $this->request->getvar('phone'),
            'Alamat' => $this->request->getvar('alamat'),
            'status' => $this->request->getvar('status')
        ];
        $this->PesananModel->insert($pesanan);

        $Id_pesanan = $this->PesananModel->InsertID();
        $data = $this->UserModel->where(['id_user' => session()->get('id_user')])->first();
        $dataTransaksi = $this->TransaksiModel->where(['id_user' => session()->get('id_user')])->find();

        $dataTransaksi = [
            'Id_pesanan' => $Id_pesanan,
            'id_user' => $data->id_user,
            'akun_bank' => $this->request->getVar('bank'),
            'bukti' => $this->request->getvar('bukti')
        ];
        $this->TransaksiModel->insert($dataTransaksi);

        //($dataTransaksi);
        session()->setFlashdata('pesan', 'data pesanan disimpan.');
        return redirect()->to('pages/order')->withInput();
    }

    public function order()
    {
        // seesion masuk login
        $session = session();

        if ($session->has('nama_user') == null) {
            return redirect()->to('C_login');
        }

        $requestB = $this->PesananModel->getOrder($_SESSION['id_user']);
        // var_dump(json_encode($requestB));
        // die();
        $request = [];

        foreach ($requestB as $key => $value) {
            array_push($request, $value);
        }

        $data = [
            'title' => 'List Order',
            'validation' => \config\Services::validation(),
            'requested' => $request

        ];
        //var_dump(json_encode($request));
        //die();
        return view('pages/order', $data);
    }


    public function upload()
    {
        if (!$this->validate([
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
            return redirect()->to('/Pages/order')->withInput();
        }

        // ambil id
        $id_transaksi = $this->request->getVar('id_transaksi');
        // ambil gambar ke folder
        $filegambar = $this->request->getFile('gambar');

        //generate nama gambar random
        $namagambar = $filegambar->getRandomName();

        // save gambar ke folder
        $filegambar->move('img/upload', $namagambar);

        $this->TransaksiModel->save([
            'Id_transaksi' => $id_transaksi,
            'bukti' => $namagambar
        ]);

        session()->setFlashdata('pesan', 'Bukti berhasil diupload.');

        return redirect()->to('/Pages/order');
    }

    public function delete()
    {
        $Id_pesanan = $this->request->getVar('id_pesanan');
        $Id_transaksi = $this->request->getVar('id_transaksi');

        $this->PesananModel->hapus($Id_pesanan);
        $this->TransaksiModel->hapus($Id_transaksi);
        session()->setFlashdata('pesan', 'Pesanan Dibatalkan.');
        return redirect()->to('/Pages/order');
    }

    public function downloadPDF()
    {
        $Id_pesanan = $this->request->getVar('id_pesanan');
        $Id_transaksi = $this->request->getVar('id_transaksi');

        $pesanan = $this->PesananModel->find($Id_pesanan);
        $transaksi = $this->TransaksiModel->find($Id_transaksi);
        $data = [
            'paket' => $this->PaketModel->find($pesanan->id_paket),
            'transaksi' => $transaksi,
            'pesanan' => $pesanan
        ];

        $html = view('pages/cetak_pesanan', $data);
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
}
