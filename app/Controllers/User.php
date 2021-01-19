<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends Controller
{
    public function index()
    {
        $session = session();

        $model_user = new UserModel();
        $allData = $model_user->getWhere(['level'=>'user'])->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'user',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'user'         => $allData
        ];
        echo view('main/user_data', $data);
    }

    public function ubah($id = null)
    {
        $session = session();
        
        $model_user = new UserModel();
        $allData = $model_user->getWhere(['user_id' => $id])->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'User',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'user'         => $allData
        ];
        echo view('main/edit_user_data', $data);
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
                'data'      => 'user',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
        ];
        echo view('main/tambah_user_data', $data);
    }

    public function add()
    {
        helper(['form', 'url']);

        $error = $this->validate([
			'user_name' 			    => 'required|min_length[3]|max_length[20]',
			'user_email' 		        => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'user_password' 		    => 'required|min_length[6]|max_length[200]',
			'user_password_confirm' 	=> 'matches[user_password]'
        ]);
        $session = session();
        $model_user = new UserModel();
        $user_id = null;
        $user_name = $this->request->getVar('user_name');
        $user_email = $this->request->getVar('user_email');
        $user_password =  password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT);
        $level = $this->request->getVar('level');

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'User',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'error'        => $this->validator
        ];

        if(!$error)
        {   
        	echo view('user/tambah', $data);
        } 
        else 
        {
	        $stored = [
	            'user_id' => $user_id,
	            'user_name'  => $user_name,
	            'user_email'  => $user_email,
	            'user_password'  => $user_password,
	            'user_created_at'  => null,
	            'level'  => $level,
	        ];

        	$model_user->insert($stored);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'User Berhasil Ditambah');

        	return redirect()->to(base_url('/user'));
        }
    }
    public function edit()
    {
        helper(['form', 'url']);

        $error = $this->validate([
            'user_id' => 'required'
        ]);
        $session = session();
        $model_user = new UserModel();
        
        $user_id = $this->request->getVar('user_id');
        $user_name = $this->request->getVar('user_name');
        $user_email = $this->request->getVar('user_email');
        $level = $this->request->getVar('level');
        
        $allData = $model_user->getWhere(['user_id' => $user_id])->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'User',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'User'         => $allData,
            'error'        => $this->validator
        ];

        if(!$error)
        {
        	return redirect()->to(base_url('user/ubah/'.$user_id));
        } 
        else 
        {
	        $stored = [
	            'user_name'  => $user_name,
	            'user_email'  => $user_email,
	            'level'  => $level,
	        ];

        	$model_user->update($user_id, $stored);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'User Berhasil Diubah');

        	return redirect()->to(base_url('/User'));
        }
    }
    function delete($id)
    {
        $UserModel = new UserModel();

        $UserModel->where('user_id', $id)->delete(['user_id' => $id]);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'User Berhasil Dihapus');

        return redirect()->to(base_url('/user'));
    }

    public function change_password($id)
    {
        $error = $this->validate([
            ]);
            $session = session();
            $model_user = new UserModel();
            
            $allData = $model_user->getWhere(['user_id' => $id])->getResult();
    
            $data = [
                'user_id'       => $session->get('user_id'),
                'user_name'     => $session->get('user_name'),
                'user_email'    => $session->get('user_email'),
                'level'         => $session->get('level'),
                'navbar'        => [
                    'data'      => 'user',
                    'level'     => $session->get('level')
                ],
                'topbar'        => [
                    'user_name' => $session->get('user_name')
                ],
                'user'         => $allData
            ];
        echo view('main/ganti_password',$data);
    }
    public function change_password_act()
    {
        helper(['form', 'url']);

        $error = $this->validate([
            'user_id' => 'required'
        ]);
        $session = session();
        $model_user = new UserModel();
        
        $user_id = $this->request->getVar('user_id');
        $password = $this->request->getVar('password');
        $password_confirm = $this->request->getVar('password_confirm');
        $allData = $model_user->getWhere(['user_id' => $user_id])->getResult();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'user',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'User'         => $allData,
            'error'        => $this->validator
        ];
        if(!$error)
        {
        	return redirect()->to(base_url('user/change_password/'.$user_id));
        } 
        else 
        {
	        $stored = [
	            'user_password'  => password_hash($password, PASSWORD_DEFAULT),
	        ];

        	$model_user->update($user_id, $stored);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'Berhasil Mengganti Password User');

        	return redirect()->to(base_url('/user'));
        }
    }
}
