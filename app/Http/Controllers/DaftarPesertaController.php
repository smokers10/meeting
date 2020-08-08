<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DaftarPeserta;

class DaftarPesertaController extends Controller
{
    public function index($id)
    {
        $data = DaftarPeserta::where('id_mom', $id)->paginate(5);
        // dd($data);
        return view('mom.daftarpeserta.index', [
            'id' => $id,
            'data' => $data
        ]);
    }

    public function byId($idPeserta)
    {
        $data = DaftarPeserta::getById($idPeserta);
        return json_encode($data);
    }

    //crud
    public function publish(Request $request, $id)
    {
        $nama = $request['nama-peserta'];
        $instansi = $request['nama-instansi'];
        $absensi = $request['absensi'];
        $data = [
            'id_mom' => $id,
            'nama' => $nama,
            'instansi' => $instansi,
            'absen' => $absensi
        ];

        //echo json_encode($data);
        // $cek = $this->validate($request, [
        //     'absen' => 'required',
        // ]);

        $rest = DaftarPeserta::insert($data);

        // dd($rest);

        if ($rest)
        {
            return redirect(route('daftar-peserta-index', $id));
        }
        else
        {
            echo 'Edit Not Found';
        }
    }

    public function put(Request $request, $id)
    {
        $idPeserta = $request['id-daftar-peserta'];
        $nama = $request['nama-peserta'];
        $instansi = $request['nama-instansi'];
        $absensi = $request['absensi'];
        $data = [
            'nama' => $nama,
            'instansi' => $instansi,
            'absen' => $absensi
        ];
        $rest = DaftarPeserta::Edit($data, $idPeserta);
        if ($rest)
        {
            return redirect(route('daftar-peserta-index', $id));
        }
        else
        {
            echo 'Edit Not Found';
        }
    }
    public function remove(Request $request, $id)
    {
        $idPeserta = $request['id-daftar-peserta'];
        $rest = DaftarPeserta::Remove($idPeserta);
        if ($rest)
        {
            return redirect(route('daftar-peserta-index', $id));
        }
        else
        {
            echo 'Edit Not Found';
        }
    }
    public function search($id)
    {
        $keyword = $_GET['keyword'];
        $data = DaftarPeserta::Search($keyword, 5);
        return view('mom.daftarpeserta.index', [
            'id' => $id,
            'data' => $data
        ]);
    }
}
