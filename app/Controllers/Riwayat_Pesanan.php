<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Riwayat_Pesanan extends Controller
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
                    pes.id_pemesan
                 FROM 
                    pesanan pes, 
                    mobil mbl, 
                    jenis_bayar jb 
                 WHERE 
                    pes.id_mobil = mbl.id 
                    AND 
                    pes.id_jenis_bayar = jb.id 
                    AND 
                    pes.id_pemesan = {$session->get('user_id')}";

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
        
        echo view('main/riwayat_pesanan', $data);
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
                    pes.id_pemesan
                 FROM 
                    pesanan pes, 
                    mobil mbl, 
                    jenis_bayar jb 
                 WHERE 
                    pes.id_mobil = mbl.id 
                    AND 
                    pes.id_jenis_bayar = jb.id 
                    AND 
                    pes.id_pemesan = {$session->get('user_id')}
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
        echo view('main/detail_pesanan', $data);
    }
}
