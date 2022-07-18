<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'id_akses',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = md5($value);
    }

    public static function login($username, $pass)
    {
        // cek apakah username sama password ada di database
        $users = DB::table('tb_user')
            ->where('username', $username)
            ->where('password', $pass)
            ->get();

        return $users;
    }

    public static function find($username)
    {
        $user = DB::table('tb_user')
            ->where('username', $username)
            ->get();

        return $user;
    }

    public static function register($nama, $username, $pass)
    {
        $user = DB::insert('INSERT INTO tb_user (nama, username, password, id_akses) VALUES (?, ?, ?,?)', [$nama, $username, $pass, 2]);

        return $user;
    }

    public static function findById($id)
    {
        $user = DB::select("SELECT a.id_user, a.nama, a.username, a.password, b.nama_akses, b.id_akses FROM tb_user a, tb_akses b WHERE a.id_akses=b.id_akses AND id_user='$id'");

        $dataUser = [];
        foreach ($user as $data) {
            $dataUser = [
                'id_user' => $data->id_user,
                'nama' => $data->nama,
                'username' => $data->username,
                'password' => $data->password,
                'id_akses' => $data->id_akses,
                'nama_akses' => $data->nama_akses,
            ];
        }

        return $dataUser;
    }

    public static function edit($nama, $username, $id)
    {
        // update
        $query = DB::update("UPDATE tb_user SET nama='$nama', username='$username' WHERE id_user='$id'");
        return true;
    }

    public static function editNama($nama, $id)
    {
        // update
        $query = DB::update("UPDATE tb_user SET nama='$nama' WHERE id_user='$id'");
        return true;
    }



    public static function cekUsername($username)
    {
        $users = DB::select("SELECT * FROM tb_user");

        foreach ($users as $user) {
            if ($user->username == $username) {
                return false;
            }
        }
        return true;
    }

    public static function updatePassword($password, $id_user)
    {
        $password = md5($password);
        $update = DB::update("UPDATE tb_user SET password='$password' WHERE id_user='$id_user'");

        return;
    }
}
