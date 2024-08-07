<?php

namespace App\Models;

use CodeIgniter\Model;

class usersModels extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'no_kartu_anggota', 'fullname', 'alamat', 'no_telpon', 'tgl_lahir', 'user_image', 'date_created'];

    public function search($keyword)
    {
        return $this->table($this->table)->like('username', $keyword)->orLike('fullname', $keyword)->orLike('email', $keyword)->orLike('no_kartu_anggota', $keyword);
    }

    public function getUser($id = 0)
    {
        if ($id == 0) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }



    public function getRole($role)
    {
        // SELECT a.username,c.name from users a JOIN auth_groups_users b on a.id = b.group_id JOIN auth_groups c on c.id = b.group_id;
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.username, c.description');
        $builder->join('auth_groups_users b', 'a.id = b.user_id');
        $builder->join('auth_groups c', 'c.id = b.group_id');
        $builder->where('description', $role);
        $query = $builder->get();
        return $query;
    }

    public function getAllUser()
    {
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.id, a.no_kartu_anggota, a.username, a.fullname, a.email, a.alamat, a.tgl_lahir, a.no_telpon, c.description');
        $builder->join('auth_groups_users b', 'a.id = b.user_id');
        $builder->join('auth_groups c', 'c.id = b.group_id');
        $builder->where('description', 'User');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getUserReg($month = null)
    {
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.created_at, c.description');
        $builder->join('auth_groups_users b', 'a.id = b.user_id');
        $builder->join('auth_groups c', 'c.id = b.group_id');
        if ($month == 1) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 2) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 3) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 4) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 5) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 6) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 7) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 8) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 9) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 10) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 11) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } elseif ($month == 12) {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', $month);
        } else {
            $builder->where('description', 'User');
            $builder->where('month(created_at)', 0);
        }
        $query = $builder->get();
        return $query;
    }

    public function getDataUser($id)
    {
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.id, a.username, a.fullname, a.email, a.alamat, a.tgl_lahir, a.user_image ,a.no_telpon, a.no_kartu_anggota, c.description');
        $builder->join('auth_groups_users b', 'a.id = b.user_id');
        $builder->join('auth_groups c', 'c.id = b.group_id');
        $builder->where('a.id', $id);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getDataPermintaanKartu()
    {
        $builder = $this->db->table($this->table);
        $builder->select();
        $builder->where('no_kartu_anggota', '0');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function jumlahPermintaanKartu()
    {
        $builder = $this->db->table($this->table);
        $builder->select('no_kartu_anggota');
        $builder->where('no_kartu_anggota', '0');
        $query = $builder->get();
        return $query;
    }

    public function getKodeKartu($tgl_lahir)
    {
        $builder = $this->db->table($this->table);
        $builder->selectMax('no_kartu_anggota');
        $kodeKartu = $builder->get()->getRowArray();
        $urutan = substr($kodeKartu['no_kartu_anggota'], 9);
        $urutan++;
        $tanggalLahir = (int) substr($tgl_lahir, 8, 2);
        $bulanLahir = substr($tgl_lahir, 5, 2);
        $tahunLahir = substr($tgl_lahir, 2, 2);
        $waktu = date('y');
        $noKartu = $waktu . $tahunLahir . $bulanLahir . $tanggalLahir . sprintf("%04s", $urutan);
        return $noKartu;
    }

    public function hapusUser($id)
    {
        $builder = $this->db->table($this->table);
        $query = $builder->delete(['id' => $id]);
        return $query;
    }
}
