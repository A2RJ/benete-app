@extends('tablar::page')

@section('title', 'View Pelabuhan Disposisi')

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
                    {{ __('Pelabuhan Disposisi ') }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('pelabuhan-disposisi.index') }}" class="btn btn-primary d-none d-sm-inline-block">
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
                        Pelabuhan Disposisi List
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
                @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pelabuhan Disposisi Details</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <strong>Pelabuhan Surat Masuk Id:</strong>
                            {{ $pelabuhanDisposisi->pelabuhan_surat_masuk_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tujuan Disposisi:</strong>
                            {{ $pelabuhanDisposisi->tujuan }}
                        </div>
                        <div class="form-group">
                            <strong>Batas Waktu Tindaklanjuti:</strong>
                            {{ $pelabuhanDisposisi->batas_waktu_tindaklanjuti }}
                        </div>
                        <div class="form-group">
                            <strong>Jenis Disposisi:</strong>
                            {{ $pelabuhanDisposisi->jenis_disposisi }}
                        </div>
                        <div class="form-group">
                            <strong>Status Disposisi:</strong>
                            {{ $pelabuhanDisposisi->status_disposisi }}
                        </div>
                        <div class="form-group">
                            <strong>Catatan:</strong>
                            {{ $pelabuhanDisposisi->catatan }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection