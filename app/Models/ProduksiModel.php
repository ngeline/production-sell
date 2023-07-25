<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduksiModel extends Model
{
    protected $table            = 'produksi';
    protected $primaryKey       = 'id_pro';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tgl_pro', 'nama_brg', 'bahan', 'ukuran', 'jmlh_brg', 'harga', 'ket', 'proses1', 'proses2', 'proses3', 'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function search($keyword)
    {
        return $this->table('produksi')->like('nama_brg', $keyword);
    }

    public function cariDataAntara($nama_field, $nilai_minimal, $nilai_maksimal)
    {
        $builder = $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $nama_field . ' BETWEEN "' . $nilai_minimal . '" AND "' . $nilai_maksimal . '" ORDER BY tgl_pro DESC');
        return $builder;
    }

    public function cariDataAntaraKhusus($nama_field, $nilai_minimal, $nilai_maksimal, $fieldWhere, $valueWhere)
    {
        $builder = $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $nama_field . ' BETWEEN "' . $nilai_minimal . '" AND "' . $nilai_maksimal . '" AND ' . $fieldWhere . ' = "' . $valueWhere . '" AND deleted_at IS NULL ORDER BY tgl_pro DESC');
        return $builder;
    }

    public function whereDone()
    {
        // $where = array('status' => 'Masuk Etalase');
        $where = array('status' => 'Selesai');
        $builder = $this->table('produksi')->where($where);
        return $builder;
    }
}
