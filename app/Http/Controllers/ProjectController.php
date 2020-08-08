<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    //
    //view
    public function index()
    {
        $data = Project::paginate(5);
        return view('project.index', [
            'project' => $data
        ]);
    }
    public function add()
    {
        return view('project.create');
    }

    public function byId($idProject)
    {
        $data = Project::getById($idProject);
        return json_encode($data);
    }

    //crud
    public function publish(Request $request)
    {
        $title = $request['nama-project'];

        $rest = Project::Add(['nama_project' => $title]);

        if ($rest)
        {
            return redirect(route('project-index'));
        }
        else
        {
           return redirect(route('errors/404'));
        }
    }
    public function put(Request $request)
    {
        $idProject = $request['id-project'];
        $namaProject = $request['nama-project'];
        $data = [
            'nama_project' => $namaProject
        ];
        $rest = Project::Edit($data, $idProject);
        if ($rest)
        {
            return redirect(route('project-index'));
        }
        else
        {
            return redirect(route('errors/404'));
        }
    }
    public function remove(Request $request)
    {
        $id = $request['id-project-remove'];
        $rest = Project::Remove($id);
        if ($rest)
        {
            return redirect(route('project-index'));
        }
        else
        {
            return redirect('remove not found');
        }
    }
    public function search()
    {
        $keyword = $_GET['keyword'];
        $data = Project::Search($keyword, 5);
        return view('project.index', [
            'project' => $data
        ]);
    }

}
