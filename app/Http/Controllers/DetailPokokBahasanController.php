<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailPokokBahasan;
use App\PokokBahasan;

class DetailPokokBahasanController extends Controller
{
    public function index($id, $idPokokBahasan)
    {
        $data = DetailPokokBahasan::where('id_pokok_bahasan', $idPokokBahasan)->paginate(5);
        return view('mom.detailpokokbahasan.index', [
            'id' => $id,
            'idPokokBahasan' => $idPokokBahasan,
            'data' => $data
        ]);
    }

    public function byId($idDetailPokokBahasan)
    {
        $data = DetailPokokBahasan::getById($idDetailPokokBahasan);
        return json_encode($data);
    }

    //crud
    public function publish(Request $request, $id, $idPokokBahasan)
    {
        $no = $request['detail-no'];
        $pokokBahasan = $request['detail-pokok-bahasan'];
        $data = [
            'id_pokok_bahasan' => $idPokokBahasan,
            'no' => $no,
            'detail_pokok_bahasan' => $pokokBahasan
        ];
        //echo json_encode($data);

        $rest = DetailPokokBahasan::Add($data);

        if ($rest)
        {
            return redirect(route('detail-pokok-bahasan-index', [$id, $idPokokBahasan]));
        }
        else
        {
            echo 'Publish Not Found';
        }
    }

    public function put(Request $request, $id, $idPokokBahasan)
    {
        $idDetailPokokBahasan = $request['id-detail-pokok-bahasan'];
        $no = $request['detail-no'];
        $pokokBahasan = $request['detail-pokok-bahasan'];
        $data = [
            'no' => $no,
            'detail_pokok_bahasan' => $pokokBahasan
        ];

        $rest = DetailPokokBahasan::Edit($data, $idDetailPokokBahasan);
        if ($rest) 
        {
            return redirect(route('detail-pokok-bahasan-index', [$id, $idPokokBahasan]));
        } 
        else 
        {
            // redirect(route('errors.404'));
            echo 'Edit Not Found';
        }
    }

    public function remove(Request $request, $id, $idPokokBahasan)
    {
        $idDetailPokokBahasan = $request['id-detail-pokok-bahasan-remove'];
        $rest = DetailPokokBahasan::where('id_detail_pokok_bahasan', $idDetailPokokBahasan)->delete();
        if ($rest)
        {
            return redirect(route('detail-pokok-bahasan-index', [$id, $idPokokBahasan]));
        }
        else
        {
            return redirect(route('errors/404'));
        }
    }

}
