@extends('admin')
@section('title', 'Sənədlər')
@section('navbar-title','Sənədlər')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{ Breadcrumbs::render('document', $company, $project, $folder) }}
        </div>
        <div class="col-sm-6">
            <div class="btn-group float-right">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    Sənəd əlavə et
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a class="dropdown-item"
                       href="{{ route('companies.projects.folders.documents.contracts.create', [
                                'company' => $folder->project->company->id,
                                'project' => $folder->project->id,
                                'folder' => $folder->id,
                            ]) }}">Müqavilə</a>
                    <a class="dropdown-item"
                       href="{{ route('companies.projects.folders.documents.contract-additions.create', [
                                'company' => $folder->project->company->id,
                                'project' => $folder->project->id,
                                'folder' => $folder->id,
                            ]) }}">Müqaviləyə
                        əlavə</a>
                    <a class="dropdown-item"
                       href="{{ route('companies.projects.folders.documents.protocols.create', [
                                'company' => $folder->project->company->id,
                                'project' => $folder->project->id,
                                'folder' => $folder->id,
                            ]) }}">Protokol</a>
                    <a class="dropdown-item"
                       href="{{ route('companies.projects.folders.documents.delivery-statements.create', [
                                'company' => $folder->project->company->id,
                                'project' => $folder->project->id,
                                'folder' => $folder->id,
                            ]) }}">Təhvil-təslim
                        aktı</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @include('documents.search_card')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="display: flex;flex-direction: row;align-items: center">
                <i class="fa-solid fa-list-ol mr-2"></i>
                Sənədlərin siyahısı</h3>
        </div>

        <div class="card-body table-responsive table_content p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col" class="col-2">Nömrə</th>
                    <th scope="col" class="col-2">Tip</th>
                    <th scope="col" class="col-2">Tarix</th>
                    <th scope="col" class="col-2">Açar sözlər</th>
                    <th scope="col" class="col-3 text-center"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($documents as $document)
                    <tr id="row-{{ $document->id }}">
                        <th>{{ $loop->iteration }}</th>
                        <td style="padding: 12px 12px;">{{ $document->number }}</td>
                        <td>{{ $document->document_type }}</td>
                        <td>{{ $document->date }}</td>
                        <td>{{ $document->tags->implode('name', ',') }}</td>
                        <td class="text-right">
                            <div class="btn-group">
                                @switch($document->document_type)
                                    @case('Müqavilə')
                                        <button type="button" class="btn btn-primary btn-sm btnShowContract"
                                                data-id="{{ $document->id }}"
                                                data-bs-toggle="modal" data-bs-target="#showContractModal">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        @break

                                    @case('Protokol')
                                        <button type="button"
                                                class="btn btn-primary btn-sm btn-primary btn-sm btnShowProtocol"
                                                data-id="{{ $document->id }}"
                                                data-bs-toggle="modal" data-bs-target="#showProtocolModal">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        @break

                                    @case('Müqaviləyə Əlavə')
                                        <button type="button" class="btn btn-primary btn-sm btnShowContractAddition"
                                                data-id="{{ $document->id }}" data-bs-toggle="modal"
                                                data-bs-target="#showContractAdditionModal">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        @break

                                    @case('Təhvil-təslim aktı')
                                        <button type="button"
                                                class="btn btn-primary btn-sm btnShowDeliveryStatement"
                                                data-id="{{ $document->id }}" data-bs-toggle="modal"
                                                data-bs-target="#showDeliveryStatementModal">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        @break
                                @endswitch

                                @switch($document->document_type)
                                    @case('Müqavilə')
                                        <button
                                            onclick="location.href='{{ route('companies.projects.folders.documents.contracts.edit', ['company' => $folder->project->company->id, 'project' => $folder->project->id, 'folder' => $folder->id, 'id' => $document->id]) }}'"
                                            class="btn btn-warning btn-sm">
                                            @break

                                            @case('Protokol')
                                                <button
                                                    onclick="location.href='{{ route('companies.projects.folders.documents.protocols.edit', ['company' => $folder->project->company->id, 'project' => $folder->project->id, 'folder' => $folder->id, 'id' => $document->id]) }}'"
                                                    class="btn btn-warning btn-sm">
                                                    @break

                                                    @case('Müqaviləyə Əlavə')
                                                        <button
                                                            onclick="location.href='{{ route('companies.projects.folders.documents.contract-additions.edit', ['company' => $folder->project->company->id, 'project' => $folder->project->id, 'folder' => $folder->id, 'id' => $document->id]) }}'"
                                                            class="btn btn-warning btn-sm">
                                                            @break

                                                            @case('Təhvil-təslim aktı')
                                                                <button
                                                                    onclick="location.href='{{ route('companies.projects.folders.documents.delivery-statements.edit', ['company' => $folder->project->company->id, 'project' => $folder->project->id, 'folder' => $folder->id, 'id' => $document->id]) }}'"
                                                                    class="btn btn-warning btn-sm">
                                                                    @break
                                                                    @endswitch
                                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                                </button>
                                                                <button href="{{ route('companies.projects.folders.documents.destroy', [
                                                    'company' => $folder->project->company->id,
                                                    'project' => $folder->project->id,
                                                    'folder' => $folder->id,
                                                    'document' => $document->id,
                                                ]) }}"
                                                                        class="btn btn-danger btn-sm btnDeleteDocument"
                                                                        data-id="{{ $document->id }}">
                                                                    <i class="fa-solid fa-trash"></i></button>

                                                        </button>
                                                </button></button>
                                        <a href="{{ upload_url($document->upload->full_name) }}"
                                           class="btn btn-sm btn-info" download><i class="fa-solid fa-download"></i>
                                        </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="6">
                        <div class="text-center text-secondary">Sənəd tapılmadı</div>
                    </td>
                @endforelse
                </tbody>
            </table>
            <div class="card-footer clearfix">{{ $documents->appends(request()->all())->links() }}</div>
        </div>
    </div>
    @include('documents.js')
    @include('documents.contract.show_modal')
    @include('documents.contract-addition.show_modal')
    @include('documents.protocol.show_modal')
    @include('documents.delivery-statement.show_modal')
@endsection
