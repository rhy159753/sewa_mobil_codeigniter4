<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelJeBay;
use App\Models\ModelPesanan;
use App\Models\MobilModel;

class Book extends Controller
{
    public function index($id = null)
    {
        $session = session();
        $db = \Config\Database::connect();
        $model_jb = new ModelJeBay();
        $jb = $model_jb->get()->getResult();

        $sql = "SELECT mbl.*, mrk.merk, 
                IF(mbl.status = 'Ready', 'available', 'used') AS class 
                FROM mobil mbl, merk mrk 
                WHERE mbl.id_merk = mrk.id
                AND mbl.id = {$id}";
                
        $allData = $db->query($sql)->getResult();
        
        foreach ($allData as $key) {
            $status_data = $key->status;
        }

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'mobil',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'mobil'         => $allData,
            'jenis_bayar'   => $jb
        ];
        if($status_data == 'Ready' && $session->get('level') == 'user'){
            echo view('main/book', $data);
        } else {
            return redirect()->to(base_url('/mobil'));
        }
    }

    public function add()
    {
        helper(['form', 'url']);
        $model_pesanan = new ModelPesanan();
        $model_mobil = new MobilModel();
        
        $data = [
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'total' => $this->request->getVar('total'),
            'id_pemesan' => $this->request->getVar('pemesan'),
            'id_mobil' => $this->request->getVar('mobil'),
            'id_jenis_bayar' => $this->request->getVar('jebar'),
        ];
        
        $model_pesanan->insert($data);

        $user_id = $model_pesanan->getInsertID();
        $mobil   = $model_mobil->update($this->request->getVar('mobil'), ['status'=>'Booked']);

        $response = [
            'message' => 'success',
            'data' => $user_id
        ];

        return $this->response->setJSON($response);
    }
}
