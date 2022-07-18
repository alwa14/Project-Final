<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Routing\Controller as BaseController;


session_start();

class BarangController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['login'])) {
            $id = $_SESSION['data']['id_user'];
            $dataBarang = Barang::allData();
            $jumBarang = Barang::jumBarang();
            $jumBasket = Keranjang::jumBasket($id);

            return view('page.barang', [
                'data' => $_SESSION['data'],
                'login' => $_SESSION['login'],
                'title' => "Daftar Barang",
                'jumBarang' => $jumBarang,
                'jumBasket' => $jumBasket,
                'dataBarang' => $dataBarang,
            ]);
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }
}
