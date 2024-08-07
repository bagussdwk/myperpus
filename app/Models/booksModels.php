<?php

namespace App\Models;

use CodeIgniter\Model;

class booksModels extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'buku';
    protected $allowedFields = ['kode_buku', 'judul', 'penerbit_id', 'kategori_id', 'isbn', 'pengarang', 'jumlah_halaman', 'jumlah_stok', 'tahun_terbit', 'gambar'];


    public function search($keyword)
    {
        return $this->table($this->table)->like('judul', $keyword)->orLike('pengarang', $keyword);
    }

    public function getAllBook()
    {
        $builder = $this->db->table($this->table);
        $query =  $builder->get();
        return $query;
    }

    public function stokBuku()
    {
        $builder = $this->db->table($this->table);
        $builder->selectSum('jumlah_stok', 'totalStok');
        $query =  $builder->get()->getRow()->totalStok;
        return $query;
    }

    public function getDataBuku($id = null)
    {
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.id, a.kode_buku, a.judul, a.pengarang, a.isbn, a.pengarang, a.jumlah_halaman, a.jumlah_stok, a.tahun_terbit, a.sinopsis, a.gambar, b.nama_kategori, c.nama_penerbit');
        $builder->join('kategori b', 'a.kategori_id = b.id');
        $builder->join('penerbit c', 'c.id = a.penerbit_id');
        if ($id != null) {
            $builder->where('a.id', $id);
        }
        $builder->orderBy('kode_buku', 'ASC');
        $query = $builder->get();
        return $query;
    }

    public function getKodeBuku()
    {
        $builder = $this->db->table($this->table);
        $builder->selectMax('kode_buku');
        $kodeBuku = $builder->get()->getRowArray();
        $urutan = substr($kodeBuku['kode_buku'], 2);
        $urutan++;
        $kode_buku = 'B' . sprintf("%03s", $urutan);
        return $kode_buku;
    }
}
