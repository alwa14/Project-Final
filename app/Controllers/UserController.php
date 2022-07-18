<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Routing\Controller as BaseController;

session_start();

class UserController extends BaseController
{
    public function index()
    {
        return view("login", [
            'title' => "Login",
        ]);
    }

    public function login()
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];

        // Encrypt
        $pass = md5($pass);

        $data = User::login($username, $pass);

        if (count($data) != 0) {
            $_SESSION['data'] = (array) $data[0];
            $_SESSION['login'] = "1";
            $nama = $_SESSION['data']['nama'];

            $id = $_SESSION['data']['id_user'];
            $jumBasket = Keranjang::jumBasket($id);

            $barang = Barang::allData();

            return view('page.home', [
                'data' => $_SESSION['data'],
                'login' => $_SESSION['login'],
                'title' => "Dashboard",
                'barang' => $barang,
                'jumBasket' => $jumBasket,
                'welcome' => "Selamat Datang"
            ]);
        } else {
            return view('login', [
                'pesan' => 'Username / Password salah!',
                'username' => $username,
                'title' => "Login",
            ]);
        }
    }

    public function register()
    {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pass = md5($password);

        $user = User::find(strtolower($username));
        if (count($user) == 0) {
            if (User::register($nama, $username, $pass)) {
                return view('login', [
                    'success' => 'Berhasil membuat akun!',
                    'title' => "Login",
                ]);
            } else {
                return view('login', [
                    'gagal' => 'Terjadi error ketika pembuatan akun!',
                    'title' => "Login",
                ]);
            }
        } else {
            return view('login', [
                'gagal' => 'Username sudah ada!',
                'username' => $username,
                'title' => "Login",
                'data' => [
                    'nama' => $nama,
                    'username' => $username,
                    'password' => $password,
                ],
            ]);
        }
    }

    public function logout()
    {
        session_destroy();

        return view('login', [
            'title' => "Login",
        ]);
    }

    // Menampilkan data profile
    public function profile()
    {
        if (isset($_SESSION['login'])) {
            $id = $_SESSION['data']['id_user'];
            $jumBasket = Keranjang::jumBasket($id);

            $dataUsers = User::findById($id);
            return view('page.profile', [
                'title' => "Profile",
                'jumBasket' => $jumBasket,
                'data' => $dataUsers,
            ]);
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }

    public function edit()
    {
        // cek session login
        if (isset($_SESSION['login'])) {
            $id_user = $_SESSION['data']['id_user'];
            $nama = $_POST['nama'];
            $namaAsli = $_POST['namaAsli'];

            $username = strtolower($_POST['username']);
            $usernameAsli = strtolower($_POST['usernameAsli']);

            // ambil data jumlah keranjang user tersebut
            $jumBasket = Keranjang::jumBasket($id_user);

            // cek apakah id_user dari session dari form sama atau tidak
            if ($id_user == $_POST['id_user']) {
                $_SESSION['data']['nama'] = $nama;
                $_SESSION['data']['username'] = $username;

                // cek apakah nama dan username yg diinput berubah atau masih inputan yang sama
                if ($nama != $namaAsli || $username != $usernameAsli) {

                    // cek apakah username yg diinput ada di database atau tidak ada
                    // jika tidak ada maka akan di update baru sesuai dengan yg di form
                    // jika ada, maka cuma akan di update nama
                    if (User::cekUsername($username)) {
                        // melakukan query edit untuk user
                        $edit = User::edit($nama, $username, $id_user);
                        // ambil data user
                        $user = User::findById($id_user);

                        $_SESSION['data']['nama'] = $nama;
                        $_SESSION['data']['username'] = $username;
                        return view('page.profile', [
                            'title' => "Profile",
                            'jumBasket' => $jumBasket,
                            'data' => $user,
                            'pesan' => "Berhasil edit profil!",
                        ]);
                    } else {
                        $edit = User::editNama($nama, $id_user);
                        $user = User::findById($id_user);
                        $_SESSION['data']['nama'] = $nama;

                        if ($username != $usernameAsli) {
                            return view('page.profile', [
                                'title' => "Profile",
                                'jumBasket' => $jumBasket,
                                'data' => $user,
                                'gagal' => "Username sudah ada!",
                            ]);
                        } else {
                            return view('page.profile', [
                                'title' => "Profile",
                                'jumBasket' => $jumBasket,
                                'data' => $user,
                                'pesan' => "Berhasil edit profil!",
                            ]);
                        }
                    }
                } else {
                    $user = User::findById($id_user);
                    return view('page.profile', [
                        'title' => "Profile",
                        'jumBasket' => $jumBasket,
                        'data' => $user,
                    ]);
                }
            } else {
                $dataUsers = User::findById($id_user);

                return view('page.profile', [
                    'title' => "Profile",
                    'jumBasket' => $jumBasket,
                    'data' => $dataUsers,
                    'gagal' => "Gagal edit profil!",
                ]);
            }
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }

    public function changePassword()
    {
        $password = $_POST['password'];
        $passlama = $_POST['passlama'];

        if (isset($_SESSION['login'])) {
            $id_user = $_SESSION['data']['id_user'];

            // ambil data jumlah keranjang user tersebut
            $jumBasket = Keranjang::jumBasket($id_user);
            // ambil data user
            $user = User::findById($id_user);

            if (md5($passlama) == $_SESSION['data']['password']) {
                if (md5($password) != $_SESSION['data']['password']) {
                    User::updatePassword($password, $id_user);

                    // ambil data user
                    $user = User::findById($id_user);
                    $_SESSION['data']['password'] = $user['password'];

                    return view('page.profile', [
                        'title' => "Profile",
                        'jumBasket' => $jumBasket,
                        'data' => $user,
                        'pesan' => "Berhasil mengganti password!",
                    ]);
                } else {


                    return view('page.profile', [
                        'title' => "Profile",
                        'jumBasket' => $jumBasket,
                        'data' => $user,
                        'gagal' => "Password tidak boleh sama seperti Password sebelumnya!",
                    ]);
                }
            } else {
                return view('page.profile', [
                    'title' => "Profile",
                    'jumBasket' => $jumBasket,
                    'data' => $user,
                    'gagal' => "Password lama salah!",
                ]);
            }
        } else {
            return view('login', [
                'title' => "Login",
            ]);
        }
    }
}