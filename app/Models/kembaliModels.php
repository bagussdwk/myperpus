<?php

namespace App\Models;

use CodeIgniter\Model;

class kembaliModels extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'pengembalian';
    protected $allowedFields = ['id_peminjaman', 'lamaHariTelat', 'dendaPerHari', 'totalDenda', 'tgl_pengembalian'];

    public function getKembali($id = 0)
    {
        if ($id == 0) {
            return $this->findAll();
        }

        return $this->where(['id_peminjaman' => $id])->first();
    }

    public function getAllKembali($id = null)
    {
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.id, a.id_peminjaman, a.tgl_pengembalian, a.totalDenda, a.dendaPerHari, b.no_peminjaman, b.tgl_kembali, b.id_buku, b.totalpinjam');
        $builder->join('peminjaman b', 'a.id_peminjaman = b.id');
        if ($id != null) {
            $builder->where('a.id_peminjaman', $id);
        }
        $builder->orderBy('id', 'ASC');
        $query = $builder->get();
        return $query;
    }

    public function updateTambahStok($data)
    {
        $stok = $data['totalpinjam'];
        $id_buku = $data['id_buku'];
        $sql = "UPDATE buku SET jumlah_stok = jumlah_stok + '$stok' WHERE id = '$id_buku'";
        return $this->db->query($sql);
    }

    public function hapusPengembalian($id)
    {
        $builder = $this->db->table($this->table);
        $query = $builder->delete(['id' => $id]);
        return $query;
    }
}
