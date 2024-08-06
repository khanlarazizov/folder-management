@extends('admin')
@section('title','Layihələr')
@section('navbar-title','Layihələr')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{ Breadcrumbs::render('project',$company) }}
        </div>
        <div class="col-sm-6">
            <a class="btn btn-primary ms-4 float-sm-right p-2" role="button" data-bs-toggle="modal"
               data-bs-target="#addProjectModal">
                Layihə Əlavə Et<i class="fa-solid fa-plus fa-sm" style="color: #ffffff;margin-left: 7px"></i></a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="display: flex;flex-direction: row;align-items: center">
                <i class="fa-solid fa-list-ol mr-2"></i>
                Layihələrin siyahısı</h3>
            <div class="card-tools">
                <form action="">
                    <div class="input-group input-group">
                        <input type="text" name="name" id="name" class="form-control form-control-sm"
                               placeholder="Layihə adı"
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
                @forelse($projects as $project)
                    <tr id="row-{{$project->id}}">
                        <th>{{ $loop->iteration }}</th>
                        <td style="padding: 12px 8px">
                            <a href="{{ route('companies.projects.folders.index',['company' => $project->company->id,'project'=>$project->id]) }}"
                               style="display:block;">{{$project->name}}</a>
                        </td>
                        <td class="text-right">
                            <div class="btn-group">
                                <button href="" class="btn btn-sm btn-warning btnProjectEdit"
                                        data-id="{{$project->id}}"><i
                                        class="fa-regular fa-pen-to-square"></i></button>
                                <button href="" class="btn btn-sm btn-danger btnProjectDelete"
                                        data-id="{{$project->id}}"><i
                                        class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="5">
                        <div class="text-center text-secondary">Layihə tapılmadı</div>
                    </td>
                @endforelse
                </tbody>
            </table>
            <div class="card-footer clearfix">{{ $projects->appends(request()->all())->links() }}</div>

        </div>
    </div>
    @include('folders.project.create_modal')
    @include('folders.project.edit_modal')
    @include('folders.project.js')
@endsection
