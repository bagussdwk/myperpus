<?php

namespace App\Models;

use CodeIgniter\Model;

class penerbitModels extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'penerbit';
    protected $useTimestamps = true;


    public function getAllPenerbit()
    {
        $builder = $this->db->table($this->table);
        $query =  $builder->get();
        return $query;
    }
}
