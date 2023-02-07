<?php

namespace App\Models;

use CodeIgniter\Model;

class EtalaseModel extends Model
{
    protected $table            = 'etalase';
    protected $primaryKey       = 'id_et';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pro', 'tgl_et', 'nama_et', 'jmlh_et', 'ket_et'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function search($keyword)
    {
        return $this->table('etalase')->like('nama_et', $keyword);
    }
}
