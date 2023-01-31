<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduksiModel extends Model
{
    protected $table            = 'produksi';
    protected $primaryKey       = 'id_pro';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tgl_pro', 'nama_brg', 'bahan', 'ukuran', 'jmlh_brg', 'harga', 'ket', 'proses1', 'proses2', 'proses3'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function search($keyword)
    {
        return $this->table('produksi')->like('nama_brg', $keyword);
    }
}
