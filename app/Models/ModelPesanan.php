<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'tgl_pinjam', 'tgl_kembali', 'total', 'id_pemesan', 'id_mobil', 'id_jenis_bayar'];
}
