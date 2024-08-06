@extends('admin')
@section('title', 'Şirkətlər')
@section('navbar-title','Şirkətlər')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{ Breadcrumbs::render('company') }}
        </div>
        <div class="col-sm-6">
            <a class="btn btn-primary float-sm-right p-2" role="button" data-bs-toggle="modal"
               data-bs-target="#addCompanyModal">
                Şirkət Əlavə Et<i class="fa-solid fa-plus fa-sm" style="color: #ffffff;margin-left: 7px"></i></a>
        </div>
    </div>

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="display: flex;flex-direction: row;align-items: center">
                <i class="fa-solid fa-list-ol mr-2"></i>
                Şirkətlərin siyahısı</h3>
            <div class="card-tools">
                <form action="">
                    <div class="input-group input-group">
                        <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Şirkət adı"
                               value="{{ request()->get('name') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-default">
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
                    <th scope="col" class="col-3"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($companies as $company)
                    <tr id="row-{{ $company->id }}">
                        <th>{{ $loop->iteration }}</th>
                        <td style="padding: 12px 8px"><a href="{{ route('companies.projects.index', $company->id) }}"
                               style="display:block;">{{ $company->name }}</a>
                        </td>
                        <td class="text-right">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-warning btnCompanyEdit"
                                        data-id="{{ $company->id }}"><i
                                        class="fa-regular fa-pen-to-square"></i></button>
                                <button href="" class="btn btn-sm btn-danger btnCompanyDelete" data-id="{{ $company->id }}"><i
                                        class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="5">
                        <div class="text-center text-secondary">Şirkət tapılmadı</div>
                    </td>
                @endforelse
                </tbody>
            </table>
            <div class="card-footer clearfix">{{ $companies->appends(request()->all())->links() }}</div>
        </div>
    </div>

    @include('folders.company.create_modal')
    @include('folders.company.edit_modal')
    @include('folders.company.js')
@endsection
