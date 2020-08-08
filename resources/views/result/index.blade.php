@extends('layouts.app')

@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Laporan</h3>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> Buat Laporan
                </div>
                <div class="panel-body">
                    
                    <form action="{{ route('result-create') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">

                                <label for="selectProject">Pilih Project</label>
                                <select class="form-control" name="id-project" id="id-project" required>
                                    <option value="0">Pilih Project</option>
                                    @foreach ($project as $pr)
                                        <option value="{{ $pr->id_project }}">{{ $pr->nama_project }}</option>
                                    @endforeach
                                </select>

                                <br>

                                <label for="selectProject">Pilih Agenda</label>
                                <select class="form-control" name="id-mom" id="id-mom" required>
                                    <option value="0">Agenda Kosong</option>
                                </select>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Buat Laporan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#id-project').on('change', function () {
            var tt = $(this).val();
            var data = '';
            $.ajax({
                type: "GET",
                url: "{{ url('detail-mom/by-project/') }}"+'/'+tt,
                dataType: "json",
                success: function (response) {
                    if (response.length) 
                    {
                        for (let i = 0; i < response.length; i++) 
                        {
                            data += '<option value="'+response[i].id_mom+'">'+response[i].agenda+'</option>';
                            // console.log(response[i]);
                        }   
                    } 
                    else 
                    {
                        data = '<option value="0">Agenda Kosong</option>';
                    }
                    $('#id-mom').html(data);
                }
            });
        });
    });
</script>
@endsection