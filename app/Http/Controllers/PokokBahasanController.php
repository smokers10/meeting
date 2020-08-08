<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PokokBahasan;

class PokokBahasanController extends Controller
{
    public function index($id)
    {
        $data = PokokBahasan::where('id_mom', $id)->paginate(5);
        return view('mom.pokokbahasan.index', [
            'id' => $id,
            'data' => $data
        ]);
    }

    public function byId($idPokokBahasan)
    {
        $data = PokokBahasan::getById($idPokokBahasan);
        return json_encode($data);
    }

    //crud
    public function publish(Request $request, $id)
    {
        $no = $request['no'];
        $pokokBahasan = $request['pokok-bahasan'];
        $data = [
            'id_mom' => $id,
            'no' => $no,
            'pokok_bahasan' => $pokokBahasan
        ];
        //echo json_encode($data);

        $rest = PokokBahasan::Add($data);

        if ($rest)
        {
            return redirect(route('pokok-bahasan-index', $id));
        }
        else
        {
            echo 'publich Not Found';
        }
    }

    public function put(Request $request, $id)
    {
        $idPokokBahasan = $request['id-pokok-bahasan'];
        $no = $request['no'];
        $pokokBahasan = $request['pokok-bahasan'];
        $data = [
            'no' => $no,
            'pokok_bahasan' => $pokokBahasan
        ];

        $rest = PokokBahasan::Edit($data, $idPokokBahasan);
        if ($rest) {
            return redirect(route('pokok-bahasan-index', $id));
        } else {
            // redirect(route('errors.404'));
            echo 'Edit Not Found';
        }
    }

    public function remove(Request $request, $id)
    {
        $idPokokBahasan = $request['id-pokok-bahasan'];
        $rest = PokokBahasan::Remove($idPokokBahasan);
        if ($rest)
        {
            return redirect(route('pokok-bahasan-index', $id));
        }
        else
        {
            return redirect(route('errors/404'));
        }
    }

    public function search($id)
    {
        $keyword = $_GET['keyword'];
        $data = PokokBahasan::Search($id, $keyword, 5);
        return view('mom.pokokbahasan.index', [
            'id' => $id,
            'data' => $data
        ]);
    }

}
