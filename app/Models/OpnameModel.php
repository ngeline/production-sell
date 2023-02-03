<?php

namespace App\Models;

use CodeIgniter\Model;

class OpnameModel extends Model
{
    protected $table            = 'opname';
    protected $primaryKey       = 'id_opn';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pro', 'tgl_opn', 'nama_opn', 'jmlh_opn', 'ket_opn'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function search($keyword)
    {
        return $this->table('opname')->like('nama_opn', $keyword);
    }
}
