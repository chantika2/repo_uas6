<?php

namespace App\Controllers;

//use App\Controllers\BaseController;
use App\Models\Modelmahasiswa;
//use CodeIgniter\HTTP\ResponseInterface;

class Mahasiswa extends BaseController
{
    public function index()
    {
        return view('mahasiswa/viewTampildata');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()){
            $mhs = new Modelmahasiswa;
            $data = [
                'tampildata' => $mhs->findAll()
            ];
            $msg = [
                'data' => view('mahasiswa/datamahasiswa', $data)
            ];
            echo json_encode($msg);
        }else{
            exit('Maaf Tidak Dapat di Proses');
        }
    }

    public function formtambah()
    {
        if($this->request->isAJAX()){
            $msg=[
                'data' => view('mahasiswa/modaltambah')
            ];
            echo json_encode($msg);
        }else{
            exit('Maaf tidak dapat di proses');
        }
    }

    public function simpandata()
    {
        if($this->request->isAjax()){
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nim' => [
                    'label' => 'NIM',
                    'rules' => 'required|is_unique[mahasiswa049.nim049]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Tidak Boleh ada yang sama, silahkan coba yang lain',
                    ]
                ],

                'nama' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required[mahasiswa049.nama049]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],

                'tmplahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required[mahasiswa049.tmplahir049]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],

                'tgllahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required[mahasiswa049.tgllahir049]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],

                'jenkel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required[mahasiswa049.jenkel049]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],

            ]);

            if (!$valid){
                $msg = [
                 'error' => [
                    'nim' => $validation->getError('nim'),
                    'nama' => $validation->getError('nama'),
                    'tmplahir' => $validation->getError('tmplahir'),
                    'tgllahir' => $validation->getError('tgllahir'),
                    'jenkel' => $validation->getError('jenkel'),
                 ]   
                 ];

                }else{
                    $simpandata = [
                        'nim049' => $this->request->getPost('nim'),
                        'nama049' => $this->request->getPost('nama'),
                        'tmplahir049' => $this->request->getPost('tmplahir'),
                        'tgllahir049' => $this->request->getPost('tgllahir'),
                        'jenkel049' => $this->request->getPost('jenkel'),
                    ];
                    $mhs = new Modelmahasiswa;
                    $mhs->insert($simpandata);

                    $msg = [
                        'sukses' => 'Data Mahasiswa Berhasil di simpan!!!'
                    ];
                }
                 echo json_encode($msg);
        }else{
            exit('Maaf tidak dapat di proses');
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()){
            $id_mahasiswa049 = $this->request->getVar('id_mahasiswa049');

            $mhs = new Modelmahasiswa;
            $row = $mhs->find($id_mahasiswa049);
            $data = [
                //sebelah kanan field pada tbl mahasiswa
                'id_mahasiswa049' => $row['id_mahasiswa049'],
                'nim049' => $row['nim049'],
                'nama049' => $row['nama049'],
                'tmplahir049' => $row['tmplahir049'],
                'tgllahir049' => $row['tgllahir049'],
                'jenkel049' => $row['jenkel049'],
            ];
            $msg= [
                'sukses' =>view('mahasiswa/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if($this->request->isAJAX()){
            //jika benar/valid
            $simpandata = [
                'nim049' => $this->request->getPost('nim'),
                'nama049' => $this->request->getPost('nama'),
                'tmplahir049' => $this->request->getPost('tmplahir'),
                'tgllahir049' => $this->request->getPost('tgllahir'),
                'jenkel049' => $this->request->getPost('jenkel'),
            ];
            $mhs = new Modelmahasiswa;
            $id_mahasiswa049 = $this->request->getVar('id_mahasiswa049');
            $mhs->update($id_mahasiswa049, $simpandata);

            $msg=[
                'sukses' => 'Data Mahasiswa berhasil di update!!!'
            ];
            echo json_encode($msg);
        }else{
            exit('Maaf tidak dapat di proses');
        }
    }

    public function hapus()
    {
        if($this->request->isAJAX()){
            $id_mahasiswa049 = $this->request->getVar('id_mahasiswa049');
            $mhs = new Modelmahasiswa;

            $mhs->delete($id_mahasiswa049);

            $msg =[
                'sukses' => "Mahasiswa Berhasil di Hapus!!!"
            ];
            echo json_encode($msg);
        }
    }

}
