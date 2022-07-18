<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_barang',
        'id_merek',
        'stok_barang',
        'harga_beli',
        'harga_jual',
        'tgl_masuk',
        'model_bahan',
        'ukuran',
        'warna',
        'gambar',
    ];

    public static function allData()
    {
        // $data = DB::table('tb_barang')
        //     ->get();

        // return $data;

        $data = DB::select("SELECT b.id_barang, b.nm_barang, c.merk, b.stok_barang, b.harga_beli, b.harga_jual, b.tgl_masuk, b.model_bahan, b.ukuran, b.warna, b.gambar FROM  tb_barang b, tb_merk c WHERE b.id_merk=c.id_merk");

        return $data;
    }

    public static function find($nm_barang)
    {
        $data = DB::select("SELECT * FROM tb_barang WHERE nm_barang LIKE '%?%'", [$nm_barang]);

        return $data;
    }
}
