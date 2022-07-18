<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'qty',
        'total_bayar',
        'id_user',
    ];

    public static function addData($id_barang, $id_user, $qty, $total_bayar, $id_keranjang)
    {
        $id_barang = htmlspecialchars($id_barang);
        $id_user = htmlspecialchars($id_user);
        $qty = htmlspecialchars($qty);
        $total_bayar = htmlspecialchars($total_bayar);

        $sql = DB::insert('INSERT INTO tb_transaksi (id_barang, qty, total_bayar, id_user) VALUES (?, ?, ?, ?)', [$id_barang, $qty, $total_bayar, $id_user]);

        $del = DB::delete("DELETE FROM tb_keranjang WHERE id_keranjang='$id_keranjang' AND id_user='$id_user'");
        $dataBarang = DB::select("SELECT * FROM tb_barang WHERE id_barang='$id_barang'");

        $sisaStok = 0;
        foreach ($dataBarang as $row) {
            $qtyBarang = $row->stok_barang;
            $sisaStok = $qtyBarang - $qty;
        }


        $decrement = DB::update("UPDATE tb_barang SET stok_barang='$sisaStok' WHERE id_barang='$id_barang'");

        $data = DB::select("SELECT * FROM tb_transaksi WHERE id_user='$id_user'");

        return $data;
    }

    public static function buyAll($id_user)
    {
        $getBasket = DB::select("SELECT a.id_barang, a.id_keranjang, a.qty, a.id_user, b.harga_jual, b.stok_barang FROM tb_keranjang a, tb_barang b WHERE a.id_user='$id_user' AND a.id_barang=b.id_barang");

        foreach ($getBasket as $data) {
            $del = DB::delete("DELETE FROM tb_keranjang WHERE id_keranjang='$data->id_keranjang' AND id_user='$id_user'");

            $qtyBarang = $data->stok_barang;
            $sisaStok = $qtyBarang - $data->qty;

            $decrement = DB::update("UPDATE tb_barang SET stok_barang='$sisaStok' WHERE id_barang='$data->id_barang'");

            $total = $data->harga_jual * $data->qty;
            $addData = DB::insert("INSERT INTO tb_transaksi (id_barang, qty, total_bayar, id_user) VALUES (?, ?, ?, ?)", [$data->id_barang, $data->qty, $total, $data->id_user]);
        }

        $data = DB::select("SELECT * FROM tb_transaksi WHERE id_user='$id_user'");

        return $data;
    }
}
