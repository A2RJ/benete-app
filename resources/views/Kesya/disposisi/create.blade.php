@extends('tablar::page')

@section('title', 'Tambah Kesya Disposisi')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Tambah
                </div>
                <h2 class="page-title">
                    {{ __('Kesya Disposisi ') }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('kesya-surat-masuk.index') }}" class="btn btn-primary d-none d-sm-inline-block">
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
        @if(config('tablar','display_alert'))
        @include('tablar::common.alert')
        @endif
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kesya Disposisi Detail</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('kesya-surat-masuk.disposisi.store', ['kesya_surat_masuk' => $kesyaDisposisi->kesya_surat_masuk_id]) }}" id="ajaxForm" role="form" enctype="multipart/form-data">
                            @csrf
                            @include('Kesya.disposisi.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection