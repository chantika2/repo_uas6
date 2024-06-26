<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeldosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';

    protected $useAutoIncrement = true;

    //field wajib diisi
    protected $allowedFields = ['nidn' ,'nama', 'tmplahir', 'tgllahir', 'jenkel', 'jabatan'];
}
