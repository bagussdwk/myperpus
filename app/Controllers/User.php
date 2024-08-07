<?php

namespace App\Controllers;

use App\Models\usersModels;
use App\Models\booksModels;
use App\Models\pinjamModels;
use App\Models\kembaliModels;
use DateTime;

class User extends BaseController
{
    protected $usersModels;
    protected $booksModels;
    protected $pinjamModels;
    protected $kembaliModels;
    public function __construct()
    {
        $this->usersModels = new usersModels();
        $this->booksModels = new booksModels();
        $this->pinjamModels = new pinjamModels();
        $this->kembaliModels = new kembaliModels();
    }

    public function index()
    {
        if (in_groups('admin')) {
            return redirect()->to('admin/dashboard');
        } else {
            $this->dashboard();
        }
    }

    public function dashboard()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Dashboard',
            'sidebar' => 'Dashboard'
        ];
        echo view('menu/dashboard', $data);
    }
    public function profile()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Profile',
            'sidebar' => 'Profile'
        ];
        echo view('menu/profile', $data);
    }
    public function editprofile()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Edit Profile',
            'sidebar' => 'Profile'
            // 'user' => $this->usersModels->getUser($id)
        ];
        return view('menu/editprofile', $data);
    }

    public function update($id)
    {

        $oldUser = $this->usersModels->getUser($this->request->getVar('id'));
        if ($oldUser['username'] == $this->request->getVar('username')) {
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[users.username]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $rule_title,
                'errors' => [
                    'required' => '{field} wajib di isi!',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'no_telpon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'user_image' => [
                'rules' => 'max_size[user_image,10240]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Foto terlalu besar, maks size 10mb!',
                    'is_image' => "Anda belum memilih foto!",
                    'mime_in' => "Anda tidak memilih foto!"
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            // dd($validation);
            return redirect()->back()->withInput();
        }

        // dd($this->request->getVar());
        $email = $this->request->getVar('email');
        $filename = "img/user-profile-picture/" . $email;
        if (file_exists($filename)) {
        } else {
            mkdir("img/user-profile-picture/" . $email, 0777, false);
        }


        $fileUserImage = $this->request->getFile('user_image');

        // check image, is it an old picture?
        if ($fileUserImage->getError() == 4) {
            $nameUserImage = $this->request->getVar('oldUserImage');
        } else {
            // get name cover
            $nameUserImage = $fileUserImage->getRandomName();
            // move img
            $fileUserImage->move('img/user-profile-picture/' . $email, $nameUserImage);
            // delete old cover
            if ($this->request->getVar('oldUserImage') == 'user.png') {
            } else {
                unlink('img/user-profile-picture/' . $email . '/' . $this->request->getVar('oldUserImage'));
            }
        }

        $this->usersModels->save([
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'fullname' => $this->request->getVar('fullname'),
            'no_telpon' => $this->request->getVar('no_telpon'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'user_image' => $nameUserImage
        ]);

        session()->setFlashdata('msg', 'User profile updated successfully');
        return redirect()->to(base_url('user/profile'));
    }

    public function hapusFoto($id)
    {
        $user = $this->usersModels->getUser($id);
        $email = $user['email'];
        $image = $user['user_image'];
        if (!file_exists("img/user-profile-picture/" . $email . '/' . $image)) {
            $this->usersModels->save([
                'id' => $id,
                'user_image' => 'user.png'
            ]);
        } else if (file_exists("img/user-profile-picture/" . $email . '/' . $image)) {
            unlink("img/user-profile-picture/" . $email . '/' . $image);
            $this->usersModels->save([
                'id' => $id,
                'user_image' => 'user.png'
            ]);
        }
        return redirect()->to(base_url('user/editprofile'));
    }

    public function peminjaman()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Peminjaman Buku',
            'sidebar' => 'Peminjaman Buku',
            'buku' => $this->booksModels->getDataBuku()->getResult()
        ];
        echo view('menu/peminjaman', $data);
    }
    public function pinjam()
    {
        $this->pinjamModels->save([
            'id_buku' => $this->request->getVar('id'),
            'id_user' => $this->request->getVar('id_user'),
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'totalpinjam' => $this->request->getVar('totalpinjam'),
            'status' => 'Proses'
        ]);

        session()->setFlashdata('msg', 'Peminjaman buku telah sukses, silahkan datang ke perpustakaan untuk konfirmasi peminjaman buku');
        return redirect()->to('user/riwayatpeminjaman');
    }
    public function hapuspeminjaman($id = 0)
    {
        if ($id == 0) {
            return redirect()->to('user');
        }
        $this->pinjamModels->hapusPeminjaman($id);
        return redirect()->to('user/riwayatpeminjaman')->with('msg', 'Delete peminjaman successfully');;
    }
    public function pengembalian($id = null, $id_buku = null)
    {
        if ($id == null && $id_buku == null) {
            return redirect()->to('user/dashboard');
        }
        $tgl_pengembalian = date('Y-m-d');
        // dd($tgl_pengembalian);
        $tgl_kembali = $this->pinjamModels->getPinjam($id);
        $kembali = $tgl_kembali[0]->tgl_kembali;
        // dd($kembali);
        $date1 = new DateTime($tgl_pengembalian);
        $date2 = new DateTime($kembali);
        $interval = $date1->diff($date2);
        // dd($interval->format("%R%a"));
        $hari = $interval->format("%a");
        if ($interval->format("%R%a") > 0) {
            $totalDenda = 0 * $hari;
        } elseif ($interval->format("%R%a") < 0) {
            $totalDenda = 5000 * $hari;
        } else {
            $totalDenda = 0 * $hari;
        }
        // dd($totalDenda);
        if ($this->kembaliModels->getKembali($id)) {
        } else {
            $this->kembaliModels->save([
                'id_peminjaman' => $id,
                'tgl_pengembalian' => date('y-m-d'),
                'dendaPerHari' => '5000',
                'lamaHariTelat' => $hari,
                'totalDenda' => $totalDenda
            ]);
        }

        session()->setFlashdata('msg', 'Silahkan datang ke perpustakaan untuk konfirmasi pengembalian buku');
        return redirect()->to('user/viewPengambilan/' . $id);
    }

    public function viewPengambilan($id)
    {
        $idKembali = $this->kembaliModels->getAllKembali($id)->getRow();
        if ($idKembali == null) {
            return redirect()->to('user/riwayatpeminjaman');
        } else {
            $data = [
                'appName' => 'E-Perpus',
                'title' => 'Pengembalian Buku',
                'sidebar' => 'Riwayat Peminjaman',
                'pengembalian' => $this->kembaliModels->getAllKembali($id)->getRow()
            ];
            echo view('menu/pengembalianbuku', $data);
        }
    }


    public function riwayatpeminjaman()
    {
        $id = user()->id;
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Riwayat Peminjaman',
            'sidebar' => 'Riwayat Peminjaman',
            'peminjaman' => $this->pinjamModels->getAllPinjam($id)
        ];
        echo view('menu/riwayatpeminjaman', $data);
    }

    public function kartuanggota()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Kartu Anggota',
            'sidebar' => 'Kartu Anggota'
        ];
        echo view('menu/kartuanggota', $data);
    }
    public function permintaannokartu($id)
    {
        $profile = $this->usersModels->getDataUser($id);
        if ($profile->fullname == NULL) {
            session()->setFlashdata('msg', 'Silahkan isi data profile terlebih dahulu secara lengkap!!!');
            return redirect()->to('user/kartuanggota');
        }
        if ($profile->no_telpon == NULL) {
            session()->setFlashdata('msg', 'Silahkan isi data profile terlebih dahulu secara lengkap!!!');
            return redirect()->to('user/kartuanggota');
        }
        if ($profile->alamat == NULL) {
            session()->setFlashdata('msg', 'Silahkan isi data profile terlebih dahulu secara lengkap!!!');
            return redirect()->to('user/kartuanggota');
        }
        if ($profile->tgl_lahir == NULL) {
            session()->setFlashdata('msg', 'Silahkan isi data profile terlebih dahulu secara lengkap!!!');
            return redirect()->to('user/kartuanggota');
        } else {
            $this->usersModels->save([
                'id' => $id,
                'no_kartu_anggota' => '0'
            ]);
            session()->setFlashdata('msg', 'Permintaan kartu anggota anda sukses');
            return redirect()->to('user/kartuanggota');
        }
    }
    public function koleksibuku()
    {
        $currentPage = $this->request->getVar('page_buku') ? $this->request->getVar('page_buku') : 1; // Ngambil Url Page_user
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $books = $this->booksModels->search($keyword);
        } else {
            $books = $this->booksModels;
        };

        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Koleksi Buku',
            'sidebar' => 'Koleksi Buku',
            'buku' => $books->paginate(10, 'buku'), // Jika angka paginate ingin dirubah, ubah juga di Viewnya bagian foreach 'No'
            'pager' => $this->booksModels->pager,
            'currentPage' => $currentPage
        ];
        echo view('menu/koleksibuku', $data);
    }

    public function detailbook($id)
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Detail Buku',
            'sidebar' => 'Koleksi Buku',
            'book' => $this->booksModels->getDataBuku($id)->getRow()
        ];
        if (empty($data['book'])) {
            return redirect()->to('admin/koleksibuku');
        }
        echo view('menu/detailbuku', $data);
    }
}
