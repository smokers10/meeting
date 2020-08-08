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
                        <li><a href="{{ route('pokok-bahasan-index', $id) }}">Pokok Bahasan</a></li>
                        <li class="active"><a href="{{ route('gallery-index', $id) }}">Gallery</a></li>
                        <li><a href="{{ route('mom-kesimpulan', $id) }}">Kesimpulan</a></li>
                    </ul>
                </div>
                <div class="panel-body top-operation">
                    <label for="image">Pilih Gambar</label>
                    <form
                        enctype="multipart/form-data"
                        method="POST"
                        action="{{ route('gallery-publish', $id) }}">
                        @csrf
                        <div class="col-lg-5 search-head-outer">
                            <div class="input-group search-head">
                                <input type="file" name="image" id="image" required>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary pull-right" type="submit">
                            <i class="fa fa-plus-circle"></i>
                            Tambah
                        </button>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="table-responsive table-data">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Tanggal</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($data as $img)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <div
                                                class="image"
                                                style="
                                                    background-image: url({{ asset('/img/gallery/thumbnails/'.$img->gambar) }});
                                                "></div>
                                        </td>
                                        <td>{{ $img->created_at }}</td>
                                        <td class="text-right">
                                            <form
                                                id="deleteGallery{{ $img->id_gallery }}"
                                                action="{{ route('gallery-remove', $id) }}"
                                                method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                                <input
                                                    type="hidden"
                                                    value="{{ $img->id_gallery }}"
                                                    name="id-gallery"
                                                    id="id-gallery">
                                            </form>
                                            <a href="{{ route('gallery-remove', $id) }}" onclick="event.preventDefault();
                                                document.getElementById('deleteGallery'+{{ $img->id_gallery }}).submit();">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
