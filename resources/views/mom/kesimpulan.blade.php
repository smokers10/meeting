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
                    <i class="fa fa-group fa-fw"></i> nama meeting
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li><a href="{{ route('daftar-peserta-index', $id) }}">Daftar Peserta</a></li>
                        <li><a href="{{ route('pokok-bahasan-index', $id) }}">Pokok Bahasan</a></li>
                        <li><a href="{{ route('gallery-index', $id) }}">Gallery</a></li>
                        <li class="active"><a href="#">Kesimpulan</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <form action="{{ route('mom-publish-kesimpulan') }}" method="POST">
                        @csrf
                        <div class="form-group"> 
                            <input type="hidden" name="id-mom" value="{{ $id }}" required>

                            <label for="kesimpulan">Kesimpulan</label>
                            <textarea 
                                class="form-control" 
                                name="kesimpulan" 
                                required 
                                id="kesimpulan" 
                                placeholder="Kesimpulan Meeting"></textarea>
                            <div style="text-align: right; margin-top: 20px;">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
