<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Routing\Controller as BaseController;

session_start();

class PageController extends BaseController
{

    public function index()
    {
        if (isset($_SESSION['login'])) {
            $barang = Barang::allData();
            $id = $_SESSION['data']['id_user'];
            $jumBasket = Keranjang::jumBasket($id);

            return view('page.home', [
                'data' => $_SESSION['data'],
                'barang' => $barang,
                'login' => $_SESSION['login'],
                'title' => "Dashboard",
                'jumBasket' => $jumBasket,
            ]);
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }

    public static function insertBasket()
    {
        $id_user = $_SESSION['data']['id_user'];
        $id_barang = $_POST['id_barang'];
        $barang = Barang::allData();
        $qty = $_POST['qty'];


        if (isset($_SESSION['login'])) {
            if ($id_user == $_POST['id_user']) {
                $jumBasket = Keranjang::insert($id_barang, $id_user, $qty);

                return view('page.home', [
                    'data' => $_SESSION['data'],
                    'barang' => $barang,
                    'login' => $_SESSION['login'],
                    'title' => "Dashboard",
                    'jumBasket' => $jumBasket,
                    'success' => 'Berhasil Menambahkan ke Keranjang!',
                ]);
            } else {
                $jumBasket = Keranjang::jumBasket($id_user);

                return view('page.home', [
                    'data' => $_SESSION['data'],
                    'barang' => $barang,
                    'login' => $_SESSION['login'],
                    'title' => "Dashboard",
                    'jumBasket' => $jumBasket,
                    'pesan' => "Gagal Menambahkan ke Keranjang!",
                ]);
            }
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }
}