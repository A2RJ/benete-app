@extends('tablar::page')

@section('title', 'View Dokumentasi')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    View
                </div>
                <h2 class="page-title">
                    {{ __('Dokumentasi ') }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('dokumentasi.index') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 14l-4 -4l4 -4"></path>
                            <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dokumentasi Detail</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <strong>User:</strong>
                            {{ $dokumentasi->user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $dokumentasi->type }}
                        </div>
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $dokumentasi->title }}
                        </div>
                        @if ($dokumentasi->type == 'link')
                        <div class="form-group">
                            <strong>Link:</strong>
                            {{ $dokumentasi->link }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($dokumentasi->type == 'file')
<div class="page-body">
    <div class="container-xl">
        @if(config('tablar','display_alert'))
        @include('tablar::common.alert')
        @endif
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah File</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('dokumentasi.file.store', ['dokumentasi' => $dokumentasi->id]) }}" id="ajaxForm" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label"> {{ Form::label('image') }}</label>
                                <div>
                                    {{ Form::file('image[]', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'placeholder' => 'Link', 'multiple']) }}
                                    {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="form-footer">
                                <div class="text-end">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar File</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse ($files as $file)
                            <div class="col-sm-3">
                                <div style="
                                            display: flex;
                                            flex-direction: column;
                                            align-items: center;
                                            justify-content: center;
                                            ">
                                    <img width="200" height="200" src="data:image/jpeg;base64,{{ $file->file() }}" alt="Your Image">
                                    <div class="my-2">
                                        {!! $file->download() !!}
                                    </div>
                                    <form action="{{ route('dokumentasi.file.destroy', ['dokumentasi' => $dokumentasi->id, 'file' => $file->id ]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="if(!confirm('Do you Want to Proceed?')){return false;}" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <div class="col-sm">
                                No Data Found
                            </div>
                            @endforelse
                            <div class="card-footer d-flex align-items-center">
                                {!! $files->links('tablar::pagination') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection