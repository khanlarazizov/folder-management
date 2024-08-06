@extends('admin')
@section('title','İstifadəçilər')
@section('navbar-title','İstifadəçilər')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{ Breadcrumbs::render('user') }}
        </div>
        <div class="col-sm-6 ">
            <a class="btn btn-primary ms-4 float-sm-right p-2" role="button" data-bs-toggle="modal"
               data-bs-target="#addUserModal">
                İstifadəçi Əlavə Et<i class="fa-solid fa-plus fa-sm" style="color: #ffffff;margin-left: 7px"></i></a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="display: flex;flex-direction: row;align-items: center">
                <i class="fa-solid fa-list-ol mr-2"></i>
                İstifadəçilərin siyahısı</h3>
            <div class="card-tools">
                <form action="">
                    <div class="input-group input-group">
                        <input type="text" name="name" id="name" class="form-control form-control-sm"
                               placeholder="Istifadəçi adı"
                               value="{{ request()->get('name') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-default btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body table-responsive p-0 table_content">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col" class="col-8">Ad</th>
                    <th scope="col" class="col-3 text-center"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr id="row-{{ $user->id }}">
                        <th>{{ $loop->iteration }}</th>
                        <td style="padding: 12px 8px">{{ $user->name }}</td>
                        <td class="text-right">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-warning btnUserEdit" data-id="{{ $user->id }}"><i
                                        class="fa-regular fa-pen-to-square"></i></button>
                                <button class="btn btn-sm btn-danger btnUserDelete" data-id="{{ $user->id }}"><i
                                        class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="card-footer clearfix">{{ $users->appends(request()->all())->links() }}</div>
        </div>

    @include('users.create_modal')
    @include('users.edit_modal')
    @include('users.js')
@endsection
