@extends('tablar::page')

@section('title', 'Update Kontrak Kerja Sama')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Update
                </div>
                <h2 class="page-title">
                    {{ __('Kontrak Kerja Sama ') }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('tu-kontrak-kerja-sama.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 6l11 0"></path>
                            <path d="M9 12l11 0"></path>
                            <path d="M9 18l11 0"></path>
                            <path d="M5 6l0 .01"></path>
                            <path d="M5 12l0 .01"></path>
                            <path d="M5 18l0 .01"></path>
                        </svg>
                        Kontrak Kerja Sama List
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
                        <h3 class="card-title">Kontrak Kerja Sama Details</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tu-kontrak-kerja-sama.update', $tuKontrakKerjaSama->id) }}" id="ajaxForm" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('TU.kontrak-kerja-sama.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection