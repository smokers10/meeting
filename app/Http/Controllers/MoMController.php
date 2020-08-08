<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\MoM;
use App\Project;

class MoMController extends Controller
{
    //
    public function index()
    {
        $data = MoM::paginate(5);
        $pr = Project::get();
        return view('mom.index', [
            'mom' => $data,
            'project' => $pr
        ]);
    }

    public function byId($idMom)
    {
        $data = Mom::GetById($idMom);
        return json_encode($data);
    }

    public function byProject($idProject)
    {
        $data = Mom::GetByProject($idProject);
        return json_encode($data);
    }

    public function add()
    {
        $data = Project::get();
        return view('mom.create', [
            'project' => $data
        ]);
    }

    public function edit($id)
    {
        $data = MoM::GetByid($id);
        return view('mom.edit',[
            'mom' => $data
        ]);
    }
    public function kesimpulan($id)
    {
        return view('mom.kesimpulan', [
            'id' => $id
        ]);
    }

    public function publish(Request $request)
    {
        $agenda = $request['agenda'];
        $tanggal = $request['tanggal'];
        $lokasi = $request['lokasi'];
        $id_project = $request['id-project'];
        $id = Auth::id();
        //$kesimpulan = $request['kesimpulan'];

        // if(!$id_project){
        //     $project = Project::where('id_project');
        // }

        $data = [
            'agenda' => $agenda,
            'tanggal_waktu' => $tanggal,
            'lokasi' => $lokasi,
            'id_project' => $id_project,
            'id' => $id
            //'kesimpulan' => $kesimpulan
        ];

        $rest = MoM::Insert($data);

        if ($rest) {
            return redirect(route('mom-index'));
        } else {
            echo 'Error';
        }

    }

    public function put(Request $request)
    {
        $id = $request['id-mom'];
        $idProject = $request['id-project'];
        $agenda = $request['edit-agenda'];
        $tanggal = $request['edit-tanggal'];
        $lokasi = $request['edit-lokasi'];
        // $kesimpulan = $request['edit-kesimpulan'];

        $data = [
            'agenda' => $agenda,
            'tanggal_waktu' => $tanggal,
            'lokasi' => $lokasi,
            // 'kesimpulan' => $kesimpulan,
            'id_project' => $idProject
        ];
        $rest = MoM::Edit($data, $id);
        if ($rest) {
            return redirect(route('mom-index'));
        } else {
            return redirect(route('errors/404'));
        }

    }

    public function publishKesimpulan(Request $request)
    {
        $id = $request['id-mom'];
        $kesimpulan = $request['kesimpulan'];

        $data = [
            'kesimpulan' => $kesimpulan
        ];
        $rest = MoM::Edit($data, $id);
        if ($rest) {
            return redirect(route('mom-index'));
        } else {
            return redirect(route('errors/404'));
        }

    }

    public function remove(Request $request)
    {
        $id = $request['id-mom-remove'];
        $rest = MoM::Remove($id);
        if ($rest) {
            return redirect(route('mom-index'));
        } else {
            return redirect(route('errors/404'));
        }

    }

    public function search()
    {
        $keyword = $_GET['keyword'];
        $data = MoM::Search($keyword, 5);
        return view('mom.index', [
            'mom' => $data
        ]);
    }



}
