@extends('layouts.app')

@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Detail Pokok Bahasan</h3>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> Meeting
                </div>
                <div class="panel-body">
                    {{-- <ul class="nav nav-tabs">
                        <li><a href="{{ route('daftar-peserta-index', $id) }}">Daftar Peserta</a></li>
                        <li><a href="{{ route('pokok-bahasan-index', $id) }}">Pokok Bahasan</a></li>
                        <li class="active"><a href="#">Detail Pokok Bahasan</a></li>
                        <li><a href="{{ route('gallery-index', $id) }}">Gallery</a></li>
                        <li><a href="{{ route('mom-kesimpulan', $id) }}">Kesimpulan</a></li>
                    </ul> --}}
                    <div class="row">
                        <br>
                        <div class="panel-body top-operation">
                            <div class="col-lg-5 search-head-outer">
                                <form class="form-inline" role="form" method="GET" action="#">
                                    <div class="input-group search-head">
                                        <input type="text" class="form-control input-sm" name="keyword" placeholder="Detail Pokok Bahasan">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#createModal"><div class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i> Tambah </div></a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="table-responsive table-data">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Detail Pokok Bahasan</th>
                                    {{-- <th>Pokok Bahasan</th> --}}
                                    <th width="200" class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr>
                                        <td>{{ $dt->no }}</td>
                                        <td>{{ $dt->detail_pokok_bahasan }}</td>
                                        <td class="text-right">
                                            <a class="detail-info" href="#">
                                                <button
                                                    onclick="editModal('{{ $dt->id_detail_pokok_bahasan }}')"
                                                    data-toggle="modal"
                                                    data-target="#editModal"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-edit fa-fw"></i>Edit
                                                </button>
                                            </a>
                                            <form
                                                id="deleteDetailPokokBahasan{{ $dt->id_detail_pokok_bahasan }}"
                                                action="{{ route('detail-pokok-bahasan-remove', [$id, $idPokokBahasan]) }}"
                                                method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                                <input
                                                    type="hidden"
                                                    value="{{ $dt->id_detail_pokok_bahasan }}"
                                                    name="id-detail-pokok-bahasan-remove"
                                                    id="id-detail-pokok-bahasan-remove">
                                            </form>
                                            <a href="{{ route('detail-pokok-bahasan-remove', [$id, $idPokokBahasan]) }}" onclick="event.preventDefault();
                                                document.getElementById('deleteDetailPokokBahasan'+{{ $dt->id_detail_pokok_bahasan }}).submit();">
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
                </div>

                <!-- Modal Create -->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="{{ route('detail-pokok-bahasan-publish', [$id, $idPokokBahasan]) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Tambah Detail Pokok Bahasan</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="detail-no">Nomor</label>
                                        <input type="text" class="form-control" name="detail-no" required id="detail-no" placeholder="Nomor">

                                        <label for="detail-pokok-bahasan">Detail Pokok Bahasan</label>
                                        <textarea class="form-control" name="detail-pokok-bahasan" required id="detail-pokok-bahasan" placeholder="Pokok Bahasan"></textarea>
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
                            <form action="{{ route('detail-pokok-bahasan-put', [$id, $idPokokBahasan]) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Detail Pokok Bahasan</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id-detail-pokok-bahasan" id="edit-id-detail-pokok-bahasan">

                                        <label for="no">Nomor</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="detail-no"
                                            required
                                            id="edit-detail-no"
                                            placeholder="Pokok Bahasan">

                                        <label for="pokok-bahasan">Detail Pokok Bahasan</label>
                                        <textarea
                                            type="text"
                                            class="form-control"
                                            name="detail-pokok-bahasan"
                                            required
                                            id="edit-detail-pokok-bahasan"
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
    function editModal (idDetailPokokBahasan) {
        $.ajax({
            type: "GET",
            url: "{{ url('/detail-pokok-bahasan/') }}"+'/'+idDetailPokokBahasan,
            data: "data",
            dataType: "json",
            success: function (response) {
                console.log(response[0].id_detail_pokok_bahasan);
                $('#edit-id-detail-pokok-bahasan').val(response[0].id_detail_pokok_bahasan);
                $('#edit-detail-no').val(response[0].no);
                $('#edit-detail-pokok-bahasan').val(response[0].detail_pokok_bahasan);
            }
        });
    }

</script>
@endsection
