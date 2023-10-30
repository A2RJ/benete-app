@extends('tablar::page')

@section('title')
Dashboard
@endsection

@section('content')<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dashboard</h3>
                    </div>

                    <div class="table-responsive min-vh-90">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endsection