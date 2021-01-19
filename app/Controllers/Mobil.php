<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MobilModel;
use App\Models\MerkModel;

class Mobil extends Controller
{
    public function index()
    {
        $session = session();
        $db = \Config\Database::connect();

        $sql = "SELECT mbl.*, mrk.merk, 
                IF(mbl.status = 'Ready', 'available', 'used') AS class 
                FROM mobil mbl, merk mrk 
                WHERE mbl.id_merk = mrk.id";

        $allData = $db->query($sql)->getResult();

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
            'mobil'         => $allData
        ];

        echo view('main/mobil', $data);
    }
    public function ubah($id = null)
    {
        $session = session();
        $db = \Config\Database::connect();

        $sql = "SELECT mbl.*, mrk.merk, 
                IF(mbl.status = 'Ready', 'available', 'used') AS class 
                FROM mobil mbl, merk mrk 
                WHERE mbl.id_merk = mrk.id
                AND mbl.id = {$id}";

        $allData = $db->query($sql)->getResult();
        
        $model_merk = new MerkModel();
        $allDataMerk = $model_merk->get()->getResult();

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
            'merk'         => $allDataMerk,
        ];
        echo view('main/edit_mobil', $data);
    }
    public function detail($id = null)
    {
        $session = session();
        $db = \Config\Database::connect();

        $sql = "SELECT mbl.*, mrk.merk, 
                IF(mbl.status = 'Ready', 'available', 'used') AS class 
                FROM mobil mbl, merk mrk 
                WHERE mbl.id_merk = mrk.id
                AND mbl.id = {$id}";

        $allData = $db->query($sql)->getResult();
        
        $model_merk = new MerkModel();
        $allDataMerk = $model_merk->get()->getResult();

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
            'merk'         => $allDataMerk,
        ];
        echo view('main/detail_mobil', $data);
    }
    public function tambah()
    {
        $session = session();
        $model_merk = new MerkModel();
        $allData = $model_merk->get()->getResult();

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
            'merk'          => $allData
        ];
        echo view('main/tambah_mobil', $data);
    }
    public function add()
    {
        helper(['form', 'url']);

        $error = $this->validate([
            'harga_str' => 'required',
        ]);
        $session = session();
        $model_mobil = new MobilModel();
        $id = null;
        $id_merk = $this->request->getVar('id_merk');
        $mobil = $this->request->getVar('mobil');
        $warna = $this->request->getVar('warna');
        $nopol = $this->request->getVar('nopol');
        $kursi = $this->request->getVar('kursi');
        $tahun = $this->request->getVar('tahun');
        $harga_str = preg_replace('/[Rp. ]/','',$this->request->getVar('harga_str'));

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
            'error'        => $this->validator
        ];
        if(!$error)
        {   
        	echo view('mobil/tambah/', $data);
        } 
        else 
        {
	        $stored = [
	            'id' => $id,
                'nama' => $mobil,
                'warna' => $warna,
                'no_polisi' => $nopol,
                'kursi' => $kursi,
                'tahun_beli' => $tahun,
                'harga' => $harga_str,
                'status' => 'Ready',
	            'id_merk' => $id_merk,
	        ];

        	$model_mobil->insert($stored);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'Mobil Berhasil Ditambah');

        	return redirect()->to(base_url('/mobil'));
        }
    }
    public function edit()
    {
        helper(['form', 'url']);

        $error = $this->validate([
            'harga_str' => 'required',
        ]);
        $session = session();
        $model_mobil = new MobilModel();
        $id = $this->request->getVar('id');
        $id_merk = $this->request->getVar('id_merk');
        $mobil = $this->request->getVar('mobil');
        $warna = $this->request->getVar('warna');
        $nopol = $this->request->getVar('nopol');
        $kursi = $this->request->getVar('kursi');
        $tahun = $this->request->getVar('tahun');
        $status = $this->request->getVar('status');
        $harga_str = preg_replace('/[Rp. ]/','',$this->request->getVar('harga_str'));

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
            'error'        => $this->validator
        ];
        if(!$error)
        {   
        	echo view('mobil/edit/'.$id, $data);
        } 
        else 
        {
	        $stored = [
	            'id' => $id,
                'nama' => $mobil,
                'warna' => $warna,
                'no_polisi' => $nopol,
                'kursi' => $kursi,
                'tahun_beli' => $tahun,
                'harga' => $harga_str,
                'status' => $status,
	            'id_merk' => $id_merk,
	        ];

        	$model_mobil->update($id,$stored);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'Mobil Berhasil Diubah');

        	return redirect()->to(base_url('/mobil'));
        }
    }
    function delete($id)
    {
        $MobilModel = new MobilModel();

        $MobilModel->where('id', $id)->delete($id);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'Mobil Berhasil Dihapus');

        return redirect()->to(base_url('/mobil'));
    }
}
