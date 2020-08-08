@extends('layouts.app')

@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Users</h3>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> List Users
                </div>
                <br>
                <div class="panel-body top-operation">
                    <div class="col-lg-5 search-head-outer">
                        <form
                            class="form-inline"
                            role="form"
                            method="GET"
                            action="{{ route('user-search')}}">
                            <div class="input-group search-head">
                                <input type="text" class="form-control input-sm" name="keyword" placeholder="Nama User">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#createModal">
                        <div class="btn btn-sm btn-primary pull-right">
                            <i class="fa fa-plus-circle"></i>
                            Tambah
                        </div>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive table-data">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Nomor HP</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($user as $us)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $us->name }}</td>
                                        <td>{{ $us->email }}</td>
                                        <td>{{ $us->jabatan }}</td>
                                        <td>{{ $us->no_hp }}</td>
                                        <td class="text-right">
                                            <a class="detail-info" href="#">
                                                <button
                                                    class="btn btn-primary"
                                                    onclick="editModal('{{ $us->id }}')"
                                                    data-toggle="modal"
                                                    data-target="#editModal">
                                                    <i class="fa fa-edit fa-fw"></i>Edit
                                                </button>
                                            </a>
                                            <form
                                                id="deleteUser{{ $us->id }}"
                                                action="{{ route('user-remove') }}"
                                                method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                                <input
                                                    type="hidden"
                                                    value="{{ $us->id }}"
                                                    name="id-user-remove"
                                                    id="id-user-remove">
                                            </form>
                                            <a href="{{ route('user-remove') }}" onclick="event.preventDefault();
                                                document.getElementById('deleteUser'+{{ $us->id }}).submit();">
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
                    <div class="row">
                        <div class="pull-right" id="page-control">
                            <ul class="pagination">
                                {{ $user->links() }}
                            </ul>
                        </div>
                    </div>
                </div>

                 <!-- Modal Create -->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="{{ route('user-publish') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Tambah User</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama-lengkap">Nama Lengkap</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nama-lengkap"
                                            required id="nama-lengkap"
                                            placeholder="Nama lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            required id="email"
                                            placeholder="E-mail">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            required id="password"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="jabatan"
                                            required id="jabatan"
                                            placeholder="Jabatan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama-lengkap">Nomor HP</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="no-hp"
                                            required id="no-hp"
                                            placeholder="Nomor HP">
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
                            <form action="{{ route('user-put') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit User</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="iduser" id="edit-iduser">
                                    <div class="form-group">
                                        <label for="nama-lengkap">Nama Lengkap</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nama-lengkap"
                                            id="edit-nama-lengkap"
                                            required
                                            placeholder="Nama lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            id="edit-email"
                                            required
                                            placeholder="E-mail">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            id="edit-password"
                                            required
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="jabatan"
                                            id="edit-jabatan"
                                            required
                                            placeholder="Jabatan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama-lengkap">Nomor HP</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="no-hp"
                                            id="edit-no-hp"
                                            required
                                            placeholder="Nomor HP">
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
    function editModal(iduser) {
        $.ajax({
            type: "GET",
            url: "{{ url('user/') }}"+'/'+iduser,
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#edit-iduser').val(response[0].id);
                $('#edit-nama-lengkap').val(response[0].name);
                $('#edit-email').val(response[0].email);
                $('#edit-password').val(response[0].password);
                $('#edit-jabatan').val(response[0].jabatan);
                $('#edit-no-hp').val(response[0].no_hp);
            }
        });
    }
</script>

@endsection
