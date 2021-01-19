<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MobilModel;
use App\Models\UserModel;
use App\Models\ModelPesanan;

class Dashboard extends Controller
{
    public function index()
    {
        $session = session();
        $db = \Config\Database::connect();

        $model_mobil = new MobilModel();
        $model_user = new UserModel();
        $model_pesanan = new ModelPesanan();

        $count_user = $model_user->like('level','user')->countAllResults();

        $all_pesanan = $model_pesanan->countAllResults();
        $model_pesanan->like('id_pemesan',$session->get('user_id'));
        $my_pesanan = $model_pesanan->countAllResults();

        $count_car = $model_mobil->countAllResults();
        $model_mobil->like('status','Ready');
        $avail_car = $model_mobil->countAllResults();

        $data = [
            'user_id'       => $session->get('user_id'),
            'user_name'     => $session->get('user_name'),
            'user_email'    => $session->get('user_email'),
            'level'         => $session->get('level'),
            'navbar'        => [
                'data'      => 'dashboard',
                'level'     => $session->get('level')
            ],
            'topbar'        => [
                'user_name' => $session->get('user_name')
            ],
            'cars'          => $count_car,
            'users'         => $count_user,
            'cars_avail'    => $avail_car,
            'orders'        => $all_pesanan,
            'orders_user'   => $my_pesanan,
        ];

        echo view('main/dashboard', $data);
    }
}
