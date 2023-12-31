@extends('tablar::page')

@section('title')
Dokumen Kapal
@endsection

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Daftar
                </div>
                <h2 class="page-title">
                    {{ __('Dokumen Kapal ') }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('kesya-dokumen-kapal.create') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Tambah Dokumen Kapal
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
                        <h3 class="card-title">Dokumen Kapal</h3>
                    </div>

                    @include('tablar::common.table-header', ['route' => url()->current()])

                    <div class="table-responsive min-vh-100">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                                    <th class="w-1">No.
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="6 15 12 9 18 15" />
                                        </svg>
                                    </th>

                                    <th>Nama</th>
                                    <th>Author</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Asal</th>
                                    <th>Perihal</th>
                                    <th>Lampiran</th>

                                    <th class="w-1"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($kesyaDokumenKapals as $kesyaDokumenKapal)
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select kesyaDokumenKapal"></td>
                                    <td>{{ $kesyaDokumenKapals->firstItem() + $loop->index }}</td>

                                    <td>{{ $kesyaDokumenKapal->nama }}</td>
                                    <td>{{ $kesyaDokumenKapal->user->name }}</td>
                                    <td>{{ $kesyaDokumenKapal->tanggal_masuk }}</td>
                                    <td>{{ $kesyaDokumenKapal->asal }}</td>
                                    <td>{{ $kesyaDokumenKapal->perihal }}</td>
                                    <td>{!! $kesyaDokumenKapal->lampiran !!}</td>

                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('kesya-dokumen-kapal.show',$kesyaDokumenKapal->id) }}">
                                                        Detail
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('kesya-dokumen-kapal.edit',$kesyaDokumenKapal->id) }}">
                                                        Ubah
                                                    </a>
                                                    <form action="{{ route('kesya-dokumen-kapal.destroy',$kesyaDokumenKapal->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="if(!confirm('Do you Want to Proceed?')){return false;}" class="dropdown-item text-red"><i class="fa fa-fw fa-trash"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <td>No Data Found</td>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        {!! $kesyaDokumenKapals->links('tablar::pagination') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection