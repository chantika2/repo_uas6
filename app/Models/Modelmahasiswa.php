<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelmahasiswa extends Model
{
    protected $table = 'mahasiswa049';
    protected $primaryKey = 'id_mahasiswa049';

    protected $useAutoIncrement = true;

    //field wajib diisi
    protected $allowedFields = ['nim049' ,'nama049', 'tmplahir049', 'tgllahir049', 'jenkel049'];
}
