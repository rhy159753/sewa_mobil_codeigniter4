<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelJeBay;
use App\Models\ModelPesanan;

class Pesanan extends Controller
{
    public function index()
    {
        $session = session();
        $db = \Config\Database::connect();

        $sql = "SELECT 
                pes.id as id_pesanan, 
                pes.tgl_pinjam, 
                pes.tgl_kembali, 
                pes.total, 
                mbl.nama, 
                jb.jenis_bayar, 
                pes.id_pemesan,
                uss.user_name
            FROM 
                pesanan pes, 
                mobil mbl, 
                jenis_bayar jb,
                users uss
            WHERE 
                pes.id_mobil = mbl.id 
                AND 
                pes.id_jenis_bayar = jb.id
                AND
                uss.user_id = pes.id_pemesan";

        $allData = $db->query($sql)->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'pesanan',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'pesanan'         => $allData
        ];

        echo view('main/pesanan_data', $data);
    }
    public function detail($id = null)
    {
        $session = session();
        $db = \Config\Database::connect();
        $sql = "SELECT 
                    pes.id as id_pesanan, 
                    pes.tgl_pinjam, 
                    pes.tgl_kembali, 
                    pes.total, 
                    mbl.nama, 
                    jb.jenis_bayar, 
                    pes.id_pemesan,
                    uss.user_name
                FROM 
                    pesanan pes, 
                    mobil mbl, 
                    jenis_bayar jb,
                    users uss
                WHERE 
                    pes.id_mobil = mbl.id 
                    AND 
                    pes.id_jenis_bayar = jb.id
                    AND
                    uss.user_id = pes.id_pemesan
                    AND 
                    pes.id = {$id}";
        $allData = $db->query($sql)->getResult();
        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'pesanan',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'pesanan'         => $allData
        ];
        echo view('main/detail_pesanan_data', $data);
    }
    public function ubah($id)
    {
        $session = session();
        $db = \Config\Database::connect();
        $model_jb = new ModelJeBay();
        $jb = $model_jb->get()->getResult();

        $sql = "SELECT mbl.*, mrk.merk, ps.id as id_pemesan, ps.tgl_pinjam, ps.tgl_kembali, ps.total, ps.id_jenis_bayar, 
                IF(mbl.status = 'Ready', 'available', 'used') AS class 
                FROM mobil mbl, merk mrk, pesanan ps 
                WHERE mbl.id_merk = mrk.id
                AND ps.id_mobil = mbl.id
                AND ps.id = {$id}";

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
                'data'      => 'pesanan',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'mobil'         => $allData,
            'jenis_bayar'   => $jb
        ];
        echo view('main/edit_pesanan', $data);
    }
    public function update()
    {
        helper(['form', 'url']);
        $model_pesanan = new ModelPesanan();
        $id = $this->request->getVar('id');

        $data = [
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'total' => $this->request->getVar('total'),
            'id_pemesan' => $this->request->getVar('pemesan'),
            'id_mobil' => $this->request->getVar('mobil'),
            'id_jenis_bayar' => $this->request->getVar('jebar'),
        ];

        $model_pesanan->update($id, $data);

        $user_id = $model_pesanan->getInsertID();

        $response = [
            'message' => 'success'
        ];

        return $this->response->setJSON($response);
    }
}
