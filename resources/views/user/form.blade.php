<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('name') }}</label>
    <div>
        {{ Form::text('name', $user->name, ['class' => 'form-control' .
        ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('email') }}</label>
    <div>
        {{ Form::text('email', $user->email, ['class' => 'form-control' .
            ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('Unit atau bidang') }}</label>
    <div>
        {{ Form::select('bidang', ['bidang keuangan' => 'bidang keuangan', 'bidang kesyabandaran' => 'bidang kesyabandaran', 'pengelola bmd dan persediaan' => 'pengelola bmd dan persediaan', 'bidang pegawai atau tata usaha' => 'bidang pegawai atau tata usaha', 'bidang kepelabuhan' => 'bidang kepelabuhan'], $user->bidang, ['class' => 'form-control' .
            ($errors->has('bidang') ? ' is-invalid' : ''), 'placeholder' => 'Pilih unit']) }}
        {!! $errors->first('bidang', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('password') }}</label>
    <div>
        {{ Form::password('password', ['class' => 'form-control' .
            ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'password']) }}
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('confirm password') }}</label>
    <div>
        {{ Form::password('password_confirmation', ['class' => 'form-control' .
            ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => 'password_confirmation']) }}
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