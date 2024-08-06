@extends('admin')
@section('title','Müqavilələr')
@section('navbar-title','Müqavilələr')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{ Breadcrumbs::render('contract_edit', $company, $project, $folder, $document) }}
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Müqavilə Redaktə et</h3>
        </div>
        <form
            action="{{ route('companies.projects.folders.documents.update',[
                                'company' => $folder->project->company->id,
                                'project'=>$folder->project->id,
                                'folder'=>$folder->id,
                                'document' => $document
                                ]) }}"
            method="post" id="editDocumentForm"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="document_id" id="document_id" value="{{ $document->id }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="number">Nömrə</label>
                            <input
                                type="hidden"
                                class="form-control"
                                name="document_type"
                                id="document_type"
                                value="Müqavilə">
                            <input
                                type="text"
                                class="form-control"
                                name="number"
                                id="number"
                                value="{{ $document->number }}">
                            @error('number')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date">Tarix</label>
                            <input type="date" class="form-control" name="date" id="date" value="{{ $document->date }}">
                            @error('date')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="contract_type">Növ</label>
                            <select class="form-select" id="contract_type" name="contract_type">
                                <option
                                    value="Partnyorluq" {{ $document->documentDetail->contract_type=='Partnyorluq' ? 'selected' : '' }}>
                                    Partnyorluq
                                </option>
                                <option
                                    value="Xidmət" {{$document->documentDetail->contract_type=='Xidmət' ? 'selected' : ''}}>
                                    Xidmət
                                </option>
                                <option
                                    value="Alqı-satqı" {{$document->documentDetail->contract_type=='Alqı-satqı' ? 'selected' : ''}}>
                                    Alqı-satqı
                                </option>
                            </select>
                            @error('contract_type')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="other_side_name">Digər tərəfin təmsilçisi</label>
                            <input
                                type="text"
                                class="form-control"
                                id="other_side_name"
                                name="other_side_name"
                                value="{{ $document->documentDetail->other_side_name }}">
                            @error('other_side_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6 shopping">
                        <input
                            class="form-check-input ms-0"
                            type="radio"
                            name="shopping"
                            id="shopping1"
                            value="Biz alırıq"
                            {{ $document->documentDetail->shopping=="Biz alırıq" ? 'checked' : '' }}>
                        <label class="otherside-label" style="margin-left: 20px" for="shopping1">
                            Biz alırıq
                        </label>
                    </div>
                    <div class="form-group col-6 shopping">
                        <input
                            class="form-check-input ms-0"
                            type="radio"
                            name="shopping"
                            id="shopping2"
                            value="Biz satırıq"
                            {{ $document->documentDetail->shopping=="Biz satırıq" ? 'checked' : '' }}>
                        <label class="otherside-label" style="margin-left: 20px" for="shopping2">
                            Biz satırıq
                        </label>
                    </div>
                    @error('shopping')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <input
                            class="form-check-input checkperson ms-0"
                            type="checkbox"
                            name="other_side_type"
                            id="checkperson"
                            value="Fiziki şəxs"
                            {{ $document->documentDetail->other_side_type=='Fiziki şəxs' ? 'checked' : '' }}>
                        <label class="otherside-label" style="margin-left: 20px" for="checkperson">Fiziki şəxs</label>
                    </div>
                    <div class="form-group col-6">
                        <input
                            class="form-control textperson"
                            type="text"
                            name="other_side_type"
                            id="textperson"
                            placeholder="Şirkət adı"
                            @if($document->documentDetail->other_side_type == 'Fiziki şəxs')
                                disabled
                            @else
                                value="{{ $document->documentDetail->other_side_type }}"
                            @endif>
                    </div>
                    @error('other_side_type')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="price">Dəyər</label>
                            <input
                                type="number"
                                class="form-control"
                                id="price"
                                name="price"
                                value="{{ $document->price }}">
                            @error('price')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="currency">Valyuta</label>
                            <select class="form-select" id="currency" name="currency">
                                <option value="AZN" {{ $document->currency == 'AZN' ? 'selected' : '' }}>AZN</option>
                                <option value="USD" {{ $document->currency == 'USD' ? 'selected' : '' }}>USD</option>
                            </select>
                            @error('currency')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Açar sözlər</label>
                            <select class="form-control select2 text-green" aria-label="Default select example"
                                    name="tags[]"
                                    id="tags" multiple data-live-search="true">
                                @foreach($tags as $tag)
                                    <option
                                        value="{{ $tag->id }}" {{ (in_array($tag->id, $selectedTags)) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="file" class="form-label">Fayl seç</label>
                                <br>
                                <span id="edit_file_name">{{ $document->upload->full_name }}</span>
                                <a href="{{ upload_url($document->upload->full_name) }}"
                                   class="btn" download>
                                    <i class="fa-solid fa-download"></i>
                                </a>
                                <input class="form-control" type="file" id="edit_file" name="file" accept=".pdf">
                                <input type="hidden" id="edit_uploaded_file" name="uploaded_file"
                                       value="{{ $document->upload->full_name }}">
                                <span id="edit_file_name_error" class="text-danger error-message"></span>

                                @error('uploaded_file')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="col-6 mx-auto d-flex">
                    <button class="btn btn-primary btn-lg active w-50 me-2"
                            type="submit" aria-pressed="true">Redaktə et
                    </button>
                    <a href="{{route('companies.projects.folders.documents.index',[
                                'company' => $folder->project->company->id,
                                'project'=>$folder->project->id,
                                'folder'=>$folder->id
                                ])}}" class="btn btn-secondary btn-lg active w-50"
                       role="button"
                       aria-pressed="true">Çıx</a>
                </div>
            </div>
        </form>
    </div>
    @include('documents.js')
@endsection
