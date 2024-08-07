<?php

namespace App\Models;

use CodeIgniter\Model;

class pinjamModels extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'peminjaman';
    protected $allowedFields = ['no_peminjaman', 'id_buku', 'id_user', 'tgl_pinjam', 'tgl_kembali', 'totalpinjam', 'status'];


    public function getAllPinjam($id = null)
    {
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.id, a.id_buku, a.no_peminjaman, a.tgl_pinjam, a.tgl_kembali, a.totalpinjam, a.status, a.tgl_pinjam, a.tgl_kembali, b.no_kartu_anggota, b.fullname, c.judul');
        $builder->join('users b', 'a.id_user = b.id');
        $builder->join('buku c', 'c.id = a.id_buku');
        if ($id != null) {
            $builder->where('b.id', $id);
        }
        $builder->orderBy('id', 'ASC');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getPinjam($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('id, id_buku, no_peminjaman, tgl_pinjam, tgl_kembali, totalpinjam, status');
        if ($id != null) {
            $builder->where('id', $id);
        }
        $builder->orderBy('id', 'ASC');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getNoPeminjaman()
    {
        $builder = $this->db->table($this->table);
        $builder->selectMax('no_peminjaman');
        $kodePinjam = $builder->get()->getRowArray();
        $urutan = substr($kodePinjam['no_peminjaman'], 7);
        $urutan++;
        $bulan = date('m');
        $tahun = date('y');
        $noPinjam = 'NP-' . $tahun . $bulan . sprintf("%04s", $urutan);
        return $noPinjam;
    }

    public function updateKurangStok($data)
    {
        $stok = $data['totalpinjam'];
        $id_buku = $data['id_buku'];
        $sql = "UPDATE buku SET jumlah_stok = jumlah_stok - '$stok' WHERE id = '$id_buku'";
        return $this->db->query($sql);
    }

    public function hapusPeminjaman($id)
    {
        if (in_groups('admin')) {
            $builder = $this->db->table($this->table);
            $builder->where('id', $id);
            $data = [
                'no_peminjaman' => NULL,
                'status'  => 'Ditolak',
            ];
            return $builder->update($data);
        } else {
            $builder = $this->db->table($this->table);
            $query = $builder->delete(['id' => $id]);
            return $query;
        }
    }
}
