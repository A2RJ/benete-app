@extends('tablar::page')

@section('title', 'Ubah Profile')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Ubah
                </div>
                <h2 class="page-title">
                    {{ __('Profile ') }}
                </h2>
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
                        <h3 class="card-title">User Detail</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update.profile') }}" id="ajaxForm" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label"> {{ Form::label('name') }}</label>
                                <div>
                                    {{ Form::text('name', $user->name, 
                                        ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"> {{ Form::label('email') }}</label>
                                <div>
                                    {{ Form::email('email', $user->email, 
                                        ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"> {{ Form::label('whatsapp') }}</label>
                                <div>
                                    {{ Form::text('whatsapp', $user->whatsapp, 
                                        ['class' => 'form-control' . ($errors->has('whatsapp') ? ' is-invalid' : ''), 'placeholder' => 'Whatapp number']) }}
                                    {!! $errors->first('whatsapp', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"> {{ Form::label('password') }}</label>
                                <div>
                                    {{ Form::password('password', 
                                        ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'password']) }}
                                    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"> {{ Form::label('confirm password') }}</label>
                                <div>
                                    {{ Form::password('password_confirmation', 
                                        ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => 'password_confirmation']) }}
                                    {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
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
@endsection