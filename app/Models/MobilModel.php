<?php

namespace App\Models;

use CodeIgniter\Model;

class MobilModel extends Model
{
    protected $table = 'mobil';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'nama', 'warna', 'no_polisi', 'jumlah_kursi', 'tahun_beli', 'harga', 'status', 'id_merk'];
}
