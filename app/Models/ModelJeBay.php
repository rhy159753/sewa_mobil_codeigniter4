<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJeBay extends Model
{
    protected $table = 'jenis_bayar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'jenis_bayar'];
}
