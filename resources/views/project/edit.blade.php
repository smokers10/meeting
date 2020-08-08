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
                    <i class="fa fa-group fa-fw"></i> Edit Project
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        @foreach ($project as $pr)
                            <form action="{{ route('project-put') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" value="{{ $pr->id_project }}" name="id-project">
                                        <label for="namaProject">Nama Project</label>
                                        <input type="text" class="form-control" type="hidden"
                                        name="nama-project"
                                        value="{{ $pr->nama_project }}"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-default">Save Changes</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Edit Project</h3>
            </div>
        </div>
        <div>
            <div>
                @foreach ($project as $pr)
                    <form action="{{ route('project-put') }}" method="POST">
                        @csrf
                        <input
                            type="hidden"
                            name="id-project"
                            value="{{ $pr->id_project }}"
                            required>
                        <input
                            type="text"
                            name="nama-project"
                            value="{{ $pr->nama_project }}"
                            required>
                        <input type="submit">
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</div> --}}
@endsection
