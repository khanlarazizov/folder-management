@extends('admin')
@section('title','Qovluqlar')
@section('navbar-title','Qovluqlar')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{ Breadcrumbs::render('folder',$company,$project) }}
        </div>
        <div class="col-sm-6">
            <a class="btn btn-primary ms-4 float-sm-right p-2" role="button" data-bs-toggle="modal"
               data-bs-target="#addFolderModal">
                Qovluq Əlavə Et<i class="fa-solid fa-plus fa-sm" style="color: #ffffff;margin-left: 7px"></i></a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Axtarış</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="" id="folderFilter">
                <div class="row">
                    <div class="col-4 my-2">
                        <label for="name">Qovluq adı:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Qovluq adı"
                               value="{{ request()->get('name') }}">
                    </div>
                    <div class="col-4 my-2">
                        <label for="startDate">Başlanğıc tarix:</label>
                        <input type="date" name="startDate" id="startDate" class="form-control"
                               value="{{ request()->get('startDate') }}">
                    </div>
                    <div class="col-4 my-2">
                        <label for="endDate">Son tarix:</label>
                        <input type="date" name="endDate" id="endDate" class="form-control"
                               value="{{ request()->get('endDate') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="text-right mt-2">
                        <button type="submit" class="btn btn-primary">Axtar</button>
                        <button type="submit" class="btn btn-danger btnClearFilter">Təmizlə</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="display: flex;flex-direction: row;align-items: center">
                <i class="fa-solid fa-list-ol mr-2"></i>
                Qovluqların siyahısı</h3>
        </div>

        <div class="card-body table-responsive p-0 table_content">
            <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col" class="col-4">Ad</th>
                        <th scope="col" class="col-4">Tarix</th>
                        <th scope="col" class="col-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($folders as $folder)
                        <tr id="row-{{ $folder->id }}">
                            <th>{{ $loop->iteration }}</th>
                            <td style="padding: 12px 8px">
                                <a href="{{ route('companies.projects.folders.documents.index',[
                                'company' => $folder->project->company->id,
                                'project'=>$folder->project->id,
                                'folder'=>$folder->id
                                ]) }}" style="display:block;">{{ $folder->name }}</a>
                            </td>
                            <td>{{ $folder->date }}</td>
                            <td class="text-right">
                                <div class="btn-group">
                                <a href="" class="btn btn-sm btn-warning btnFolderEdit" data-id="{{ $folder->id }}"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <a href="" class="btn btn-sm btn-danger btnFolderDelete" data-id="{{ $folder->id }}"><i
                                        class="fa-solid fa-trash"></i></a></div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="5">
                            <div class="text-center text-secondary">Qovluq tapılmadı</div>
                        </td>
                    @endforelse
                    </tbody>
                </table>
                <div class="card-footer clearfix">{{ $folders->appends(request()->all())->links() }}</div>
            </div>
        </div>
    @include('folders.folder.create_modal')
    @include('folders.folder.edit_modal')
    @include('folders.folder.js')
@endsection
