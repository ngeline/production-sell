<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table            = 'supplier';
    protected $primaryKey       = 'id_sup';
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_sup', 'alamat_sup', 'no_hp',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function search($keyword)
    {
        return $this->table('supplier')->like('nama_sup', $keyword);
    }
}
