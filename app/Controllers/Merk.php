<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MerkModel;

class Merk extends Controller
{
    public function index()
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
                'data'      => 'merk',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'merk'         => $allData
        ];
        // echo $allData;
        // echo "Welcome back, ".$session->get('user_name')."<br/>";
        // echo "Welcome back, ".$session->get('level');
        echo view('main/merk', $data);
    }

    public function ubah($id = null)
    {
        $session = session();
        $db = \Config\Database::connect();
        
        $model_merk = new MerkModel();
        $allData = $model_merk->getWhere(['id' => $id])->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'merk',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'merk'         => $allData
        ];
        echo view('main/edit_merk', $data);
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
                'data'      => 'merk',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
        ];
        echo view('main/tambah_merk', $data);
    }

    public function add()
    {
        helper(['form', 'url']);

        $error = $this->validate([
            'merk' => 'required',
        ]);
        $session = session();
        $model_merk = new MerkModel();
        $id = null;
        $merk = $this->request->getVar('merk');

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'merk',
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
	            'merk'  => $merk,
	        ];

        	$model_merk->insert($stored);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'Merk Berhasil Ditambah');

        	return redirect()->to(base_url('/merk'));
        }
    }
    public function edit()
    {
        helper(['form', 'url']);

        $error = $this->validate([
            'id' 	=> 'required',
            'merk' => 'required',
        ]);
        $session = session();
        $model_merk = new MerkModel();
        $id = $this->request->getVar('id');
        $merk = $this->request->getVar('merk');
        
        $allData = $model_merk->getWhere(['id' => $id])->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'merk',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'merk'         => $allData,
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
	            'merk'  => $merk,
	        ];

        	$model_merk->update($id, $stored);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'Merk Berhasil Diubah');

        	return redirect()->to(base_url('/merk'));
        }
    }
    function delete($id)
    {
        $MerkModel = new MerkModel();

        $MerkModel->where('id', $id)->delete($id);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'Merk Berhasil Dihapus');

        return redirect()->to(base_url('/merk'));
    }
}
