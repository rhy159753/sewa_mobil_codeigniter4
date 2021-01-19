<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelJeBay;

class Jenis_Bayar extends Controller
{
    public function index()
    {
        $session = session();

        $model_jebay = new ModelJeBay();
        $allData = $model_jebay->get()->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'jenis_bayar',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'jenis_bayar'         => $allData
        ];
        // echo $allData;
        // echo "Welcome back, ".$session->get('user_name')."<br/>";
        // echo "Welcome back, ".$session->get('level');
        echo view('main/jenis_bayar', $data);
    }

    public function ubah($id = null)
    {
        $session = session();
        $db = \Config\Database::connect();
        
        $model_jebay = new ModelJeBay();
        $allData = $model_jebay->getWhere(['id' => $id])->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'jenis_bayar',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'jenis_bayar'         => $allData
        ];
        echo view('main/edit_jenis_bayar', $data);
    }
    public function tambah()
    {
        $session = session();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'jenis_bayar',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
        ];
        echo view('main/tambah_jenis_bayar', $data);
    }

    public function add()
    {
        helper(['form', 'url']);

        $error = $this->validate([
            'jenis_bayar' => 'required',
        ]);
        $session = session();
        $model_jebay = new ModelJeBay();
        $id = null;
        $jenis_bayar = $this->request->getVar('jenis_bayar');

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'jenis_bayar',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'error'        => $this->validator
        ];

        if(!$error)
        {   
        	echo view('merk/tambah/', $data);
        } 
        else 
        {
	        $stored = [
	            'id' => $id,
	            'jenis_bayar'  => $jenis_bayar,
	        ];

        	$model_jebay->insert($stored);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'Jenis Pembayaran Berhasil Ditambah');

        	return redirect()->to(base_url('/jenis_bayar'));
        }
    }
    public function edit()
    {
        helper(['form', 'url']);

        $error = $this->validate([
            'id' 	=> 'required',
            'jenis_bayar' => 'required',
        ]);
        $session = session();
        $model_jebay = new ModelJeBay();
        $id = $this->request->getVar('id');
        $jenis_bayar = $this->request->getVar('jenis_bayar');
        
        $allData = $model_jebay->getWhere(['id' => $id])->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'jenis_bayar',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'jenis_bayar'         => $allData,
            'error'        => $this->validator
        ];

        if(!$error)
        {
        	echo view('merk/ubah/'.$id, $data);
        } 
        else 
        {
	        $stored = [
	            'id' => $id,
	            'jenis_bayar'  => $jenis_bayar,
	        ];

        	$model_jebay->update($id, $stored);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'Jenis Pembayaran Berhasil Diubah');

        	return redirect()->to(base_url('/jenis_bayar'));
        }
    }
    function delete($id)
    {
        $ModelJeBay = new ModelJeBay();

        $ModelJeBay->where('id', $id)->delete($id);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'Jenis Pembayaran Berhasil Dihapus');

        return redirect()->to(base_url('/jenis_bayar'));
    }
}
