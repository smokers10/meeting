<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\MoM;
use App\DaftarPeserta;
use App\PokokBahasan;
use App\DetailPokokBahasan;
use App\Gallery;

use PDF;

class ResultController extends Controller
{
    public function index()
    {
        $project = Project::Get();
        return view('result.index', [
            'project' => $project
        ]);
    }

    public function create(Request $requset)
    {
        $idProject = $requset['id-project'];
        $idMom = $requset['id-mom'];

        if ($idProject == '0' && $idMom == '0') 
        {
            return redirect(route('result-index'));
        } 
        else 
        {
            $project = Project::GetByid($idProject);
            $mom = MoM::GetByid($idMom);
            $daftarPeserta = DaftarPeserta::GetByMom($idMom);
            $pokokBahasan = PokokBahasan::GetByMom($idMom);
            $gallery = Gallery::where('id_mom', $idMom)->get();

            // return view(
            //     'result.result', 
            //     compact(
            //         'project',
            //         'mom',
            //         'daftarPeserta',
            //         'pokokBahasan',
            //         'gallery'
            //     )
            // );

            $pdf = PDF::loadView(
                'result.result', 
                compact(
                    'project',
                    'mom',
                    'daftarPeserta',
                    'pokokBahasan',
                    'gallery'
                )
            );
            return $pdf->stream('result.pdf');
        }

    }
}
