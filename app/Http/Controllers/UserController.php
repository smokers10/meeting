<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    //view
    public function index()
    {
        $data = User::paginate(5);
        return view('user.index', [
            'user' => $data
        ]);
    }

    public function byId($iduser)
    {
        $data = User::where('id', $iduser)->get();
        return json_encode($data);
    }

    //crud
    public function publish(Request $request)
    {
        $rest = User::insert([
            'name' => $request['nama-lengkap'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        if ($rest)
        {
            return redirect(route('user-index'));
        }
        else
        {
           return redirect(route('errors/404'));
        }
    }
    public function put(Request $request)
    {
        $iduser = $request['iduser'];
        $data = [
            'name' => $request['nama-lengkap'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ];
        $rest = User::where('id', $iduser)->update($data);
        if ($rest)
        {
            return redirect(route('user-index'));
        }
        else
        {
            return redirect(route('errors/404'));
        }
    }
    public function remove(Request $request)
    {
        $id = $request['id-user-remove'];
        $rest = User::Remove($id);
        if ($rest)
        {
            return redirect(route('user-index'));
        }
        else
        {
            return redirect(route('errors/404'));
        }
    }
    public function search()
    {
        $keyword = $_GET['keyword'];
        $data = User::Search($keyword, 5);
        return view('user.index', [
            'user' => $data
        ]);
    }
}
