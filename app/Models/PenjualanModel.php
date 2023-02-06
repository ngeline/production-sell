<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table            = 'penjualan';
    protected $primaryKey       = 'id_penj';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pro', 'marketplace', 'tgl_inp', 'nm_pro', 'banyak_brg', 'total_penj'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function search($keyword)
    {
        return $this->table('penjualan')->like('marketplace', $keyword);
    }

    public function opnameJoinProduksi()
    {
        // return $this->select('pro.nama_brg,pro.jmlh_brg,pro.harga')
    }
}
