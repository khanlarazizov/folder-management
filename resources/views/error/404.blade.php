@extends('admin')
@section('title','Xəta')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Xəta səhifəsi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Əsas səhifə</a></li>
                    <li class="breadcrumb-item active">Xəta səhifəsi</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section class="content">
        <div class="error-page">
            <h3 class="headline text-warning"> 404</h3>
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> {{ $message }}</h3>
            </div>
        </div>
    </section>

@endsection
