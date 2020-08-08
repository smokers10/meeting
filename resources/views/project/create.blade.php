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
                    <i class="fa fa-group fa-fw"></i> Create Project
                </div>
            <div class="panel-body">
                <div class="col-md-8">
                    <form action="{{ route('project-publish') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="namaProject">Nama Project</label>
                            <input type="text" class="form-control" name="nama-project" required id="namaProject" placeholder="Nama Project">
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