<?php

namespace App\Controllers;

use App\Models\usersModels;
use App\Models\booksModels;
use App\Models\pinjamModels;
use App\Models\penerbitModels;
use App\Models\kategoriModels;
use App\Models\kembaliModels;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

class Admin extends BaseController
{
    /**
     * @var AuthConfig
     */
    protected $config;

    /**
     * @var Session
     */
    protected $session;

    protected $usersModels;
    protected $booksModels;
    protected $pinjamModels;
    protected $penerbitModels;
    protected $kategoriModels;
    protected $kembaliModels;
    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');

        $this->usersModels = new usersModels();
        $this->booksModels = new booksModels();
        $this->pinjamModels = new pinjamModels();
        $this->penerbitModels = new penerbitModels();
        $this->kategoriModels = new kategoriModels();
        $this->kembaliModels = new kembaliModels();
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Dashboard',
            'sidebar' => 'Dashboard',
            'jumlahUser' => $this->usersModels->getRole('User')->getNumRows(),
            'jumlahBuku' => $this->booksModels->getAllBook()->getNumRows(),
            'jumlahPermintaanKartu' => $this->usersModels->jumlahPermintaanKartu()->getNumRows(),
            'stok' => $this->booksModels->stokBuku(),

            'userJan' => $this->usersModels->getUserReg($month = 1)->getNumRows(),
            'userFeb' => $this->usersModels->getUserReg($month = 2)->getNumRows(),
            'userMar' => $this->usersModels->getUserReg($month = 3)->getNumRows(),
            'userApr' => $this->usersModels->getUserReg($month = 4)->getNumRows(),
            'userMay' => $this->usersModels->getUserReg($month = 5)->getNumRows(),
            'userJun' => $this->usersModels->getUserReg($month = 6)->getNumRows(),
            'userJul' => $this->usersModels->getUserReg($month = 7)->getNumRows(),
            'userAug' => $this->usersModels->getUserReg($month = 8)->getNumRows(),
            'userSep' => $this->usersModels->getUserReg($month = 9)->getNumRows(),
            'userOct' => $this->usersModels->getUserReg($month = 10)->getNumRows(),
            'userNov' => $this->usersModels->getUserReg($month = 11)->getNumRows(),
            'userDec' => $this->usersModels->getUserReg($month = 12)->getNumRows()
        ];
        echo view('menu/admin/dashboard', $data);
    }
    public function datapermintaankartu()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Data Permintaan Kartu',
            'sidebar' => 'Data Permintaan Kartu',
            'user' => $this->usersModels->getDataPermintaanKartu()
        ];
        echo view('menu/admin/datapermintaankartu', $data);
    }
    public function konfirmasikartu($id)
    {

        $user = $this->usersModels->getDataUser($id);
        $tgl_lahir = $user->tgl_lahir;
        // dd($tgl_lahir);
        $noKartu = $this->usersModels->getKodeKartu($tgl_lahir);
        $this->usersModels->save([
            'id' => $id,
            'no_kartu_anggota' => $noKartu
        ]);
        return redirect()->to('admin/datapermintaankartu');
    }
    public function hapuspermintaankartu($id)
    {
        $this->usersModels->save([
            'id' => $id,
            'no_kartu_anggota' => '1'
        ]);
        return redirect()->to('admin/datapermintaankartu');
    }
    public function datauser()
    {

        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Data User',
            'sidebar' => 'Data User',
            'user' => $this->usersModels->getAllUser()
        ];
        echo view('menu/admin/datauser', $data);
    }
    public function tambahuser()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Tambah User',
            'sidebar' => 'Data User'
        ];
        echo view('menu/admin/tambahuser', $data);
    }

    public function edituser($id = null)
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Edit User',
            'sidebar' => 'Data User',
            'user' => $this->usersModels->getUser($id)
        ];
        echo view('menu/admin/edituser', $data);
    }

    public function save()
    {
        $users = model(UserModel::class);

        // Validate basics first since some password rules rely on these fields
        $rules = config('Validation')->registrationRules ?? [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|strong_password',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user              = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // Ensure default group gets assigned if set
        if (!empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // if ($this->config->requireActivation !== null) {
        //     $activator = service('activator');
        //     $sent      = $activator->send($user);

        //     if (!$sent) {
        //         return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
        //     }

        //     // Success!
        //     return redirect()->route('login')->with('message', lang('Auth.activationSuccess'));
        // }

        // Success!
        return redirect()->to('admin/datauser')->with('msg', 'Add user successfully');
    }

    public function detail($id = 0)
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Detail User',
            'sidebar' => 'Data User',
            'user' => $this->usersModels->getDataUser($id)
        ];
        if (empty($data['user'])) {
            return redirect()->to('admin');
        }
        echo view('menu/admin/detailuser', $data);
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
        return redirect()->to(base_url('admin/datauser'));
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

    public function hapus($id = 0)
    {
        if ($id == 0) {
            return redirect()->to('admin');
        }
        $this->usersModels->hapusUser($id);
        return redirect()->to('admin/datauser')->with('msg', 'Delete user successfully');
    }
    public function dataPeminjaman()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Data Peminjaman',
            'sidebar' => 'Data Peminjaman',
            'peminjaman' => $this->pinjamModels->getAllPinjam()
        ];
        echo view('menu/admin/datapeminjaman', $data);
    }

    public function konfirmasiPeminjaman($id, $id_buku, $totalpinjam)
    {
        $noPeminjaman = $this->pinjamModels->getNoPeminjaman();
        $this->pinjamModels->save([
            'id' => $id,
            'no_peminjaman' => $noPeminjaman,
            'status' => 'Pinjam'
        ]);
        $this->pinjamModels->updateKurangStok([
            'id_buku' => $id_buku,
            'totalpinjam' => $totalpinjam
        ]);
        return redirect()->to('admin/datapeminjaman')->with('msg', 'Peminjaman Buku telah dikonfirmasi');
    }


    public function hapusPeminjaman($id = 0)
    {
        if ($id == 0) {
            return redirect()->to('admin');
        }
        $this->pinjamModels->hapusPeminjaman($id);
        return redirect()->to('admin/datapeminjaman')->with('msg', 'Peminjaman telah ditolak');;
    }

    public function dataPengembalian()
    {
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Data Pengembalian',
            'sidebar' => 'Data Pengembalian',
            'pengembalian' => $this->kembaliModels->getAllKembali()->getResult()
        ];
        echo view('menu/admin/datapengembalian', $data);
    }

    public function konfirmasiPengembalian($id, $id_pinjam, $id_buku, $totalpinjam)
    {
        $this->kembaliModels->delete($id);
        $this->pinjamModels->save([
            'id' => $id_pinjam,
            'status' => 'Kembali'
        ]);
        $this->kembaliModels->updateTambahStok([
            'id_buku' => $id_buku,
            'totalpinjam' => $totalpinjam
        ]);
        return redirect()->to('admin/datapengembalian')->with('msg', 'Pengembalian Buku telah dikonfirmasi');
    }
    public function hapusPengembalian($id)
    {
        if ($id == 0) {
            return redirect()->to('admin');
        }
        $this->kembaliModels->hapusPengembalian($id);
        return redirect()->to('admin/datapengembalian')->with('msg', 'Pengembalian Buku telah dihapus');
    }

    public function lihatTransaksi()
    {
    }

    public function tambahBuku()
    {
        $kodeBuku = $this->booksModels->getKodeBuku();
        $data = [
            'appName' => 'E-Perpus',
            'title' => 'Tambah Buku',
            'sidebar' => 'Koleksi Buku',
            'penerbit' => $this->penerbitModels->getAllPenerbit()->getResult(),
            'kategori' => $this->kategoriModels->getAllKategori()->getResult(),
            'buku' => $this->booksModels->getAllBook()->getResult(),
            'kode_buku' => $kodeBuku
        ];
        echo view('menu/admin/tambahbuku', $data);
    }

    public function saveBuku()
    {
        // dd($this->request->getVar());
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[buku.judul]',
                'errors' => [
                    'required' => '{field} wajib di isi!',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'pengarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'isbn' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'jumlah_halaman' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'jumlah_stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'tahun_terbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'sinopsis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,10240]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Foto terlalu besar, maks size 10mb!',
                    'is_image' => "Anda belum memilih foto!",
                    'mime_in' => "Anda tidak memilih foto!"
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            // dd(session('error'));
            return redirect()->back()->withInput();
        }

        $fileGambar = $this->request->getFile('gambar');
        if ($fileGambar->getError() == 4) {
            $nameGambar = 'default.png';
        } else {
            // move img
            $fileGambar->move('img/buku');
            $nameGambar = url_title($this->request->getVar('judul'), '-', true);
            // dd($this->request->getVar());
        }

        $this->booksModels->save([
            'kode_buku' => $this->request->getVar('kode_buku'),
            'judul' => $this->request->getVar('judul'),
            'penerbit_id' => $this->request->getVar('penerbit'),
            'kategori_id' => $this->request->getVar('kategori'),
            'pengarang' => $this->request->getVar('pengarang'),
            'isbn' => $this->request->getVar('isbn'),
            'jumlah_halaman' => $this->request->getVar('jumlah_halaman'),
            'jumlah_stok' => $this->request->getVar('jumlah_stok'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'sinopsis' => $this->request->getVar('sinopsis'),
            'gambar' => $nameGambar
        ]);

        session()->setFlashdata('msg', 'Add book successfully');
        return redirect()->to(base_url('user/koleksibuku'));
    }
}
