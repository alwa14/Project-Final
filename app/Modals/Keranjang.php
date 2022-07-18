<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_keranjang',
        'id_barang',
        'id_user',
    ];

    public static function insert($id_barang, $id_user, $qty)
    {
        DB::insert('INSERT INTO tb_keranjang (id_barang, id_user, qty) VALUES (?, ?, ?)', [$id_barang, $id_user, $qty]);

        $jumBasket = DB::select('SELECT * FROM tb_keranjang WHERE id_user=?', [$id_user]);
        $jumBasket = count((array)$jumBasket);
        return $jumBasket;
    }

    public static function jumBasket($id)
    {
        $jum = DB::select('SELECT * FROM tb_keranjang WHERE id_user=?', [$id]);
        $jum = count((array) $jum);
        return $jum;
    }

    public static function allDataWithBarang($id)
    {
        $id = htmlspecialchars($id);
        $data = DB::select("SELECT b.id_barang, a.id_user, a.id_keranjang, a.qty, b.nm_barang, c.merk, b.stok_barang, b.harga_beli, b.harga_jual, b.tgl_masuk, b.model_bahan, b.ukuran, b.warna, b.gambar FROM tb_keranjang a, tb_barang b, tb_merk c WHERE id_user='$id' AND a.id_barang=b.id_barang AND b.id_merk=c.id_merk ORDER BY b.id_barang");

        return $data;
    }

    public static function deleteData($id_keranjang, $id_user)
    {
        $id_keranjang = htmlspecialchars($id_keranjang);
        $id_user = htmlspecialchars($id_user);
        $data = DB::select("DELETE FROM tb_keranjang WHERE id_keranjang='$id_keranjang' AND id_user='$id_user'");

        return $data;
    }
}
