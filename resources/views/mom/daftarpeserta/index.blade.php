@extends('layouts.app')

@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Daftar Peserta</h3>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> Meeting
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#">Daftar Peserta</a></li>
                        <li><a href="{{ route('pokok-bahasan-index', $id) }}">Pokok Bahasan</a></li>
                        <li><a href="{{ route('gallery-index', $id) }}">Gallery</a></li>
                        <li><a href="{{ route('mom-kesimpulan', $id) }}">Kesimpulan</a></li>
                    </ul>
                    <div class="row">
                        <br>
                        <div class="panel-body top-operation">
                            <div class="col-lg-5 search-head-outer">
                                <form class="form-inline" role="form" method="GET" action="{{ route('daftar-peserta-search', $id) }}">
                                    <div class="input-group search-head">
                                        <input type="text" class="form-control input-sm" name="keyword" placeholder="Nama Peserta">
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
                                            <th>Nama Peserta</th>
                                            <th>Instansi</th>
                                            <th>Absen</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $dt)
                                            <tr>
                                                <td>{{ $dt->nama }}</td>
                                                <td>{{ $dt->instansi }}</td>
                                                <td>
                                                    @if($dt->absen == 1)
                                                        Hadir
                                                    @else
                                                        Tidak Hadir
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <a class="detail-info" href="#">
                                                        <button
                                                            onclick="editModal('{{ $dt->id_daftar_peserta }}')"
                                                            data-toggle="modal"
                                                            data-target="#editModal"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit fa-fw"></i>Edit
                                                        </button>
                                                    </a>
                                                    <form id="deletePeserta{{ $dt->id_daftar_peserta }}" action="{{ route('daftar-peserta-remove', $id) }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="{{ $dt->id_daftar_peserta }}" name="id-daftar-peserta" id="id-daftar-peserta">
                                                    </form>
                                                    <a href="{{ route('daftar-peserta-remove', $id) }}" onclick="event.preventDefault();
                                                        document.getElementById('deletePeserta'+{{ $dt->id_daftar_peserta }}).submit();">
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
                <div>
                    <!-- Modal Create -->
                    <div class="modal fade" id="createModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <form action="{{ route('daftar-peserta-publish', $id) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Tambah Daftar Peserta</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama-peserta">Nama Peserta</label>
                                            <input type="text" class="form-control" name="nama-peserta" required id="nama-peserta" placeholder="Nama Peserta">
                                            <label for="nama-instansi">Nama Instansi</label>
                                            <input type="text" class="form-control" name="nama-instansi" required id="nama-instansi" placeholder="Nama Instansi">
                                            <label for="absensi">Absensi</label>
                                            {{-- <input type="text" class="form-control" name="absensi" required id="absensi" placeholder="Agenda"> --}}
                                            <select class="form-control" name="absensi" required id="absensi" placeholder="Absensi">
                                                <option>None</option>
                                                <option value="1">Hadir</option>
                                                <option value="0">Tidak Hadir</option>
                                            </select>
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
                                <form action="{{ route('daftar-peserta-put', $id) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Daftar Peserta</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="id-daftar-peserta" id="edit-id-daftar-peserta">
                                            <label for="nama-peserta">Nama Peserta</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="nama-peserta"
                                                required
                                                id="edit-nama-peserta"
                                                placeholder="Nama Peserta">

                                            <label for="nama-instansi">Nama Instansi</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="nama-instansi"
                                                required
                                                id="edit-nama-instansi"
                                                placeholder="Nama Instansi">

                                            <label for="absensi">Absensi</label>
                                            <select class="form-control" name="absensi" required id="absensi" placeholder="Absensi">
                                                <option value="1">Hadir</option>
                                                <option value="0">Tidak Hadir</option>
                                            </select>
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
</div>
<script>
    function editModal(idPeserta) {
        $.ajax({
            type: "GET",
            url: "{{ url('/daftar-peserta/') }}"+'/'+idPeserta,
            data: "data",
            dataType: "json",
            success: function (response) {
                console.log(response[0].nama);
                $('#edit-id-daftar-peserta').val(response[0].id_daftar_peserta);
                $('#edit-nama-peserta').val(response[0].nama);
                $('#edit-nama-instansi').val(response[0].instansi);
                $('#edit-absensi').val(response[0].absen);
            }
        });
    }
</script>
@endsection
