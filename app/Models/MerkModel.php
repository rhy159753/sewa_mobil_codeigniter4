<?php

namespace App\Models;

use CodeIgniter\Model;

class MerkModel extends Model
{
    protected $table = 'merk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'merk'];
}
