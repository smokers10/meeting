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
                    <i class="fa fa-group fa-fw"></i> Meeting
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li><a href="{{ route('daftar-peserta-index', $id) }}">Daftar Peserta</a></li>
                        <li class="active"><a href="#">Pokok Bahasan</a></li>
                        <li><a href="{{ route('gallery-index', $id) }}">Gallery</a></li>
                        <li><a href="{{ route('mom-kesimpulan', $id) }}">Kesimpulan</a></li>
                    </ul>
                    <div class="row">
                        <br>
                        <div class="panel-body top-operation">
                            <div class="col-lg-5 search-head-outer">
                                <form class="form-inline" role="form" method="GET" action="{{ route('pokok-bahasan-search', $id) }}">
                                    <div class="input-group search-head">
                                        <input type="text" class="form-control input-sm" name="keyword" placeholder="Pokok Bahasan">
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
                                            <th>Pokok Bahasan</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $dt)
                                            <tr>
                                                <td>{{ $dt->no }}</td>
                                                <td>{{ $dt->pokok_bahasan }}</td>
                                                <td class="text-right">
                                                    <a class="detail-info" href="{{ route('detail-pokok-bahasan-index', [$id, $dt->id_pokok_bahasan]) }}">
                                                        <button class="btn btn-success">
                                                            <i class="fa fa-plus fa-fw"></i>Detail Pokok Bahasan
                                                        </button>
                                                    </a>
                                                    <a class="detail-info" href="#">
                                                        <button
                                                            onclick="editModal('{{ $dt->id_pokok_bahasan }}')"
                                                            data-toggle="modal"
                                                            data-target="#editModal"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit fa-fw"></i>Edit
                                                        </button>
                                                    </a>
                                                    <form id="deletePokokBahasan{{ $dt->id_pokok_bahasan }}" action="{{ route('pokok-bahasan-remove', $id) }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        <input
                                                            type="hidden"
                                                            value="{{ $dt->id_pokok_bahasan }}"
                                                            name="id-pokok-bahasan"
                                                            id="id-pokok-bahasan">
                                                    </form>
                                                    <a href="{{ route('pokok-bahasan-remove', $id) }}" onclick="event.preventDefault();
                                                        document.getElementById('deletePokokBahasan'+{{ $dt->id_pokok_bahasan }}).submit();">
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
                                        {{ $data->links() }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Create -->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="{{ route('pokok-bahasan-publish', $id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Tambah Pokok Bahasan</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="no">No</label>
                                        <input type="text" class="form-control" name="no" required id="no" placeholder="Nomor">
                                        <label for="pokok-bahasan">Pokok Bahasan</label>
                                        <textarea class="form-control" name="pokok-bahasan" required id="pokok-bahasan" placeholder="Pokok Bahasan"></textarea>
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
                            <form action="{{ route('pokok-bahasan-put', $id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Daftar Peserta</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id-pokok-bahasan" id="edit-id-pokok-bahasan">

                                        <label for="no">Nomor</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="no"
                                            required
                                            id="edit-no"
                                            placeholder="Pokok Bahasan">

                                        <label for="pokok-bahasan">Pokok Bahasan</label>
                                        <textarea
                                            type="text"
                                            class="form-control"
                                            name="pokok-bahasan"
                                            required
                                            id="edit-pokok-bahasan"
                                            placeholder="Pokok Bahasan">
                                        </textarea>
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
    function editModal (idPokokBahasan) {
        $.ajax({
            type: "GET",
            url: "{{ url('/pokok-bahasan/') }}"+'/'+idPokokBahasan,
            data: "data",
            dataType: "json",
            success: function (response) {
                console.log(response[0].id_pokok_bahasan);
                $('#edit-id-pokok-bahasan').val(response[0].id_pokok_bahasan);
                $('#edit-no').val(response[0].no);
                $('#edit-pokok-bahasan').val(response[0].pokok_bahasan);
            }
        });
    }

</script>
@endsection
