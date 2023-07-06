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
        // return $this->table('penjualan')->like('marketplace', $keyword);
        $model = new PenjualanModel();
        $model->groupStart();
        $kolomModel = $model->allowedFields;
        foreach ($kolomModel as $kolom) {
            $model->orLike($kolom, $keyword);
        }
        return $model->groupEnd();
    }

    public function filter($filter)
    {
        $bulanInp = intVal(substr($filter, 5, 2)); // Mengambil 2 karakter berikutnya untuk bulan;
        $tahunInp = intVal(substr($filter, 0, 4)); // Mengambil 4 karakter pertama untuk tahun;
        $model = $this->table('penjualan');
        $model->groupStart();
        $model->like('MONTH(tgl_inp)', $bulanInp);
        $model->like('YEAR(tgl_inp)', $tahunInp);
        return $model->groupEnd();
    }

    public function cariDataAntara($nama_field, $nilai_minimal, $nilai_maksimal)
    {
        $builder = $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $nama_field . ' BETWEEN "' . $nilai_minimal . '" AND "' . $nilai_maksimal . '" ORDER BY tgl_inp DESC');
        return $builder;
    }
}
