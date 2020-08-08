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
                    <i class="fa fa-group fa-fw"></i> Create MoM
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        <form action="{{ route('mom-publish') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="selectProject">Select list (select one):</label>
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
                            <button type="submit" class="btn btn-default">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
