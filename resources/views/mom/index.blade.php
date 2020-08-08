@extends('layouts.app')

@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">MoM</h3>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> List MoM
                </div>
                <div class="panel-body">
                    <div class="col-lg-5 search-head-outer">
                        <form class="form-inline" role="form" method="GET" action="">
                            <div class="input-group search-head">
                                <input type="text" class="form-control input-sm" name="keyword" placeholder="Nama mom">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="" data-toggle="modal" data-target="#createModal"><div class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i> Tambah </div></a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive table-data">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Agenda</th>
                                    <th width="120">Tanggal Waktu</th>
                                    <th>Lokasi</th>
                                    <th>Kesimpulan</th>
                                    <th width="300" class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mom as $mt)
                                <tr>
                                    <td>{{ $mt->agenda }}</td>
                                    <td>{{ $mt->tanggal_waktu }}</td>
                                    <td>{{ $mt->lokasi }}</td>
                                    <td>{{ $mt->kesimpulan }}</td>
                                    <td class="text-right">
                                        <a class="detail-info" href="#">
                                            <button
                                                class="btn btn-primary"
                                                onclick="editModal('{{ $mt->id_mom }}')"
                                                data-toggle="modal"
                                                data-target="#editModal">
                                                <i class="fa fa-edit fa-fw"></i>
                                                Edit
                                            </button>
                                        </a>
                                        <a class="detail-info" href="{{ route('daftar-peserta-index', $mt->id_mom) }}">
                                            <button class="btn btn-default">
                                                <i class="fa fa-cogs fa-fw"></i>
                                                Manage
                                            </button>
                                        </a>
                                        <form
                                            id="deleteMom{{ $mt->id_mom }}"
                                            action="{{ route('mom-remove') }}"
                                            method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                            <input
                                                type="hidden"
                                                value="{{ $mt->id_mom }}"
                                                name="id-mom-remove"
                                                id="id-mom-remove">
                                        </form>
                                        <a href="{{ route('mom-remove') }}" onclick="event.preventDefault();
                                            document.getElementById('deleteMom'+{{ $mt->id_mom }}).submit();">
                                            <button class="btn btn-danger">
                                                <i class="fa fa-trash fa-fw"></i>Delete
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="pull-right" id="page-control">
                            <ul class="pagination">
                                {{ $mom->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Create -->
            <div class="modal fade" id="createModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <form action="{{ route('mom-publish') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Tambah MoM</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="selectProject">Pilih Project</label>
                                    <select class="form-control" name="id-project" id="sel1">
                                        @foreach ($project as $pr)
                                            <option value="{{ $pr->id_project }}">{{ $pr->nama_project }}</option>
                                        @endforeach
                                    </select>
                                    <label for="agenda">Agenda</label>
                                    <input type="text" class="form-control" name="agenda" required id="agenda" placeholder="Agenda">
                                    <label for="tanggalWaktu">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" required id="tanggal">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi" required id="lokasi">
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
            <!-- Modal Create -->
            <div class="modal fade" id="editModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <form action="{{ route('mom-put') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit MoM</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="id-mom" id="edit-id-mom">

                                    <label for="selectProject">Pilih Project</label>
                                    <select class="form-control" name="id-project" id="sel1">
                                        @foreach ($project as $pr)
                                            <option
                                                value="{{ $pr->id_project }}"
                                                class="project"
                                                id="project-{{ $pr->id_project }}">{{ $pr->nama_project }}</option>
                                        @endforeach
                                    </select>

                                    <label for="agenda">Agenda</label>
                                    <input type="text" class="form-control" name="edit-agenda" required id="edit-agenda" placeholder="Agenda">

                                    <label for="tanggalWaktu">Tanggal</label>
                                    <input type="date" class="form-control" name="edit-tanggal" required id="edit-tanggal">

                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control" name="edit-lokasi" required id="edit-lokasi">
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
<script>
    function editModal(idMom) {
        $.ajax({
            type: "GET",
            url: "{{ url('/detail-mom/') }}"+'/'+idMom,
            data: "data",
            dataType: "json",
            success: function (response) {
                // console.log(response[0].created_at);
                $('.project').removeAttr('selected');
                $('#project-'+response[0].id_project).attr('selected', 'true');
                $('#edit-id-mom').val(response[0].id_mom);
                $('#edit-agenda').val(response[0].agenda);
                $('#edit-tanggal').val(response[0].tanggal_waktu);
                $('#edit-lokasi').val(response[0].lokasi);
            }
        });
    }
</script>
@endsection
