<?php

namespace App\Controllers;

//use App\Controllers\BaseController;
use App\Models\Modeldosen;
//use CodeIgniter\HTTP\ResponseInterface;

class Dosen extends BaseController
{
    public function index()
    {
        return view('dosen/viewtampildata');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()){
            $dsn = new Modeldosen;
            $data = [
                'tampildata' => $dsn->findAll()
            ];
            $msg = [
                'data' => view('dosen/datadosen', $data)
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
                'data' => view('dosen/modaltambah')
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
                'nidn' => [
                    'label' => 'nidn',
                    'rules' => 'required|is_unique[dosen.nidn]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Tidak Boleh ada yang sama, silahkan coba yang lain',
                    ]
                ],

                'nama' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required[dosen.nama]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],

                'tmplahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required[dosen.tmplahir]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],

                'tgllahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required[dosen.tgllahir]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],

                'jenkel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required[dosen.jenkel]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],

                'jabatan' => [
                    'label' => 'Jabatan',
                    'rules' => 'required[dosen.jabatan]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],

            ]);

            if (!$valid){
                $msg = [
                 'error' => [
                    'nidn' => $validation->getError('nidn'),
                    'nama' => $validation->getError('nama'),
                    'tmplahir' => $validation->getError('tmplahir'),
                    'tgllahir' => $validation->getError('tgllahir'),
                    'jenkel' => $validation->getError('jenkel'),
                    'jabatan' => $validation->getError('jabatan'),
                 ]   
                 ];

                }else{
                    $simpandata = [
                        'nidn' => $this->request->getPost('nidn'),
                        'nama' => $this->request->getPost('nama'),
                        'tmplahir' => $this->request->getPost('tmplahir'),
                        'tgllahir' => $this->request->getPost('tgllahir'),
                        'jenkel' => $this->request->getPost('jenkel'),
                        'jabatan' => $this->request->getPost('jabatan'),
                    ];
                    $dsn = new Modeldosen;
                    $dsn->insert($simpandata);

                    $msg = [
                        'sukses' => 'Data dosen Berhasil di simpan!!!'
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
            $id_dosen = $this->request->getVar('id_dosen');

            $dsn = new Modeldosen;
            $row = $dsn->find($id_dosen);
            $data = [
                //sebelah kanan field pada tbl dosen
                'id_dosen' => $row['id_dosen'],
                'nidn' => $row['nidn'],
                'nama' => $row['nama'],
                'tmplahir' => $row['tmplahir'],
                'tgllahir' => $row['tgllahir'],
                'jenkel' => $row['jenkel'],
                'jabatan' => $row['jabatan'],
            ];
            $msg= [
                'sukses' =>view('dosen/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if($this->request->isAJAX()){
            //jika benar/valid
            $simpandata = [
                'nidn' => $this->request->getPost('nidn'),
                'nama' => $this->request->getPost('nama'),
                'tmplahir' => $this->request->getPost('tmplahir'),
                'tgllahir' => $this->request->getPost('tgllahir'),
                'jenkel' => $this->request->getPost('jenkel'),
                'jabatan' => $this->request->getPost('jabatan'),
            ];
            $dsn = new Modeldosen;
            $id_dosen = $this->request->getVar('id_dosen');
            $dsn->update($id_dosen, $simpandata);

            $msg=[
                'sukses' => 'Data dosen berhasil di update!!!'
            ];
            echo json_encode($msg);
        }else{
            exit('Maaf tidak dapat di proses');
        }
    }

    public function hapus()
    {
        if($this->request->isAJAX()){
            $id_dosen = $this->request->getVar('id_dosen');
            $dsn = new Modeldosen;

            $dsn->delete($id_dosen);

            $msg =[
                'sukses' => "dosen Berhasil di Hapus!!!"
            ];
            echo json_encode($msg);
        }
    }
}
