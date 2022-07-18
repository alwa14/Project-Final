<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Routing\Controller as BaseController;

session_start();

class KeranjangController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['login'])) {
            $id = $_SESSION['data']['id_user'];
            $dataKeranjang = Keranjang::allDataWithBarang($id);
            $jumBasket = Keranjang::jumBasket($id);

            return view('page.keranjang', [
                'data' => $_SESSION['data'],
                'login' => $_SESSION['login'],
                'title' => "Keranjang",
                'jumBasket' => $jumBasket,
                'dataKeranjang' => $dataKeranjang,
            ]);
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }

    public function delete()
    {
        if (isset($_SESSION['login'])) {
            $id_user = $_SESSION['data']['id_user'];
            $jumBasket = Keranjang::jumBasket($id_user);
            $dataKeranjang = Keranjang::allDataWithBarang($id_user);

            if ($id_user == $_POST['id_user']) {
                $id_keranjang = $_POST['id_keranjang'];

                // hapus dari chart
                $delete = Keranjang::deleteData($id_keranjang, $id_user);
                $dataKeranjang = Keranjang::allDataWithBarang($id_user);
                $jumBasket = Keranjang::jumBasket($id_user);

                return view('page.keranjang', [
                    'data' => $_SESSION['data'],
                    'login' => $_SESSION['login'],
                    'title' => "Keranjang",
                    'jumBasket' => $jumBasket,
                    'dataKeranjang' => $dataKeranjang,
                    'success' => 'Berhasil menghapus barang dari chart!',
                ]);
            } else {
                return view('page.keranjang', [
                    'data' => $_SESSION['data'],
                    'login' => $_SESSION['login'],
                    'title' => "Keranjang",
                    'jumBasket' => $jumBasket,
                    'dataKeranjang' => $dataKeranjang,
                    'pesan' => 'Gagal hapus barang dari chart',
                ]);
            }
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }
}