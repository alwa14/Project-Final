<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Keranjang;
use Illuminate\Routing\Controller as BaseController;

session_start();

class TransaksiController extends BaseController
{
    public function addBuy()
    {
        if (isset($_SESSION['login'])) {
            $id_user = $_SESSION['data']['id_user'];
            $dataKeranjang = Keranjang::allDataWithBarang($id_user);
            $jumBasket = Keranjang::jumBasket($id_user);

            if ($id_user == $_POST['id_user']) {
                $id_barang = $_POST['id_barang'];
                $qty = $_POST['qty'];
                $total = $_POST['harga_jual'] * $qty;
                $bayar = $_POST['bayar'];
                $id_keranjang = $_POST['id_keranjang'];

                $kembalian = $bayar - $total;

                if ($kembalian >= 0) {
                    $addTrans = Transaksi::addData($id_barang, $id_user, $qty, $total, $id_keranjang);
                    $dataKeranjang = Keranjang::allDataWithBarang($id_user);
                    $jumBasket = Keranjang::jumBasket($id_user);

                    return view('page.keranjang', [
                        'data' => $_SESSION['data'],
                        'login' => $_SESSION['login'],
                        'title' => "Keranjang",
                        'jumBasket' => $jumBasket,
                        'dataKeranjang' => $dataKeranjang,
                        'success' => 'Berhasil membeli barang! Kembalian anda sebesar IDR ' . str_replace(',', ' ', number_format($kembalian)),
                        'beli' => $addTrans,
                    ]);
                } else {
                    return view('page.keranjang', [
                        'data' => $_SESSION['data'],
                        'login' => $_SESSION['login'],
                        'title' => "Keranjang",
                        'jumBasket' => $jumBasket,
                        'dataKeranjang' => $dataKeranjang,
                        'pesan' => 'Gagal membeli barang, Uang tidak cukup! Uang anda kurang IDR ' . str_replace('-', ' ', number_format($kembalian)),
                    ]);
                }
            } else {
                return view('page.keranjang', [
                    'data' => $_SESSION['data'],
                    'login' => $_SESSION['login'],
                    'title' => "Keranjang",
                    'jumBasket' => $jumBasket,
                    'dataKeranjang' => $dataKeranjang,
                ]);
            }
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }

    public function allBuy()
    {
        if (isset($_SESSION['login'])) {
            $id_user = $_SESSION['data']['id_user'];
            $dataKeranjang = Keranjang::allDataWithBarang($id_user);
            $jumBasket = Keranjang::jumBasket($id_user);

            if ($id_user == $_POST['id_user']) {
                $bayar = $_POST['bayar'];
                $total = $_POST['total'];
                $kembalian = $bayar - $total;

                if ($kembalian >= 0) {
                    $addTransAll = Transaksi::buyAll($id_user);
                    $dataKeranjang = Keranjang::allDataWithBarang($id_user);
                    $jumBasket = Keranjang::jumBasket($id_user);

                    return view('page.keranjang', [
                        'data' => $_SESSION['data'],
                        'login' => $_SESSION['login'],
                        'title' => "Keranjang",
                        'jumBasket' => $jumBasket,
                        'dataKeranjang' => $dataKeranjang,
                        'success' => 'Berhasil membeli semua barang! Kembalian anda sebesar IDR ' . str_replace(',', ' ', number_format($kembalian)),
                        'beli' => $addTransAll,
                    ]);
                } else {
                    return view('page.keranjang', [
                        'data' => $_SESSION['data'],
                        'login' => $_SESSION['login'],
                        'title' => "Keranjang",
                        'jumBasket' => $jumBasket,
                        'dataKeranjang' => $dataKeranjang,
                        'pesan' => 'Gagal membeli barang, Uang tidak cukup! Uang anda kurang IDR ' . str_replace('-', ' ', number_format($kembalian)),
                    ]);
                }
            } else {
                return view('page.keranjang', [
                    'data' => $_SESSION['data'],
                    'login' => $_SESSION['login'],
                    'title' => "Keranjang",
                    'jumBasket' => $jumBasket,
                    'dataKeranjang' => $dataKeranjang,
                ]);
            }
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }
}