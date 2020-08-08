@extends('layouts.app')

@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Projects</h3>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> List Project
                </div>
                <br>
                <div class="panel-body top-operation">
                    <div class="col-lg-5 search-head-outer">
                        <form class="form-inline" role="form" method="GET" action="{{ route('project-search' )}}">
                            <div class="input-group search-head">
                                <input type="text" class="form-control input-sm" name="keyword" placeholder="Nama Project">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#createModal"><div class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i> Tambah </div></a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive table-data">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Project</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($project as $pr)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $pr->nama_project }}</td>
                                        <td class="text-right">
                                            <a class="detail-info" href="#">
                                                <button
                                                    class="btn btn-primary"
                                                    onclick="editModal('{{ $pr->id_project }}')"
                                                    data-toggle="modal"
                                                    data-target="#editModal">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                    Edit
                                                </button>
                                            </a>
                                            <form
                                                id="deleteProject{{ $pr->id_project }}"
                                                action="{{ route('project-remove') }}"
                                                method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                                <input
                                                    type="hidden"
                                                    value="{{ $pr->id_project }}"
                                                    name="id-project-remove"
                                                    id="id-project-remove">
                                            </form>
                                            <a href="{{ route('project-remove') }}" onclick="event.preventDefault();
                                                document.getElementById('deleteProject'+{{ $pr->id_project }}).submit();">
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash fa-fw"></i>Delete
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="pull-right" id="page-control">
                            <ul class="pagination">
                                {{ $project->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
                 <!-- Modal Create -->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="{{ route('project-publish') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Tambah Project</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama-project">Nama project</label>
                                        <input type="text" class="form-control" name="nama-project" required id="nama-project" placeholder="Nama Project">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="{{ route('project-put') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Project</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id-project" id="edit-id-project">
                                        <label for="nama-project">Nama Project</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nama-project"
                                            required
                                            id="edit-nama-project"
                                            placeholder="Nama Project">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function editModal(idProject) {
        $.ajax({
            type: "GET",
            url: "{{ url('project/') }}"+'/'+idProject,
            data: "data",
            dataType: "json",
            success: function (response) {
                console.log(response[0]);
                $('#edit-id-project').val(response[0].id_project);
                $('#edit-nama-project').val(response[0].nama_project);
            }
        });
    }
</script>

@endsection
