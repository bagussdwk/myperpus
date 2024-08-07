<?php

namespace App\Models;

use CodeIgniter\Model;

class kategoriModels extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'kategori';
    protected $useTimestamps = true;


    public function getAllKategori()
    {
        $builder = $this->db->table($this->table);
        $query =  $builder->get();
        return $query;
    }
}
