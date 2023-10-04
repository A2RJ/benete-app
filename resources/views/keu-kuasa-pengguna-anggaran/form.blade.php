
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nama') }}</label>
    <div>
        {{ Form::text('nama', $keuKuasaPenggunaAnggaran->nama, ['class' => 'form-control' .
        ($errors->has('nama') ? ' is-invalid' : ''), 'placeholder' => 'Nama']) }}
        {!! $errors->first('nama', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuKuasaPenggunaAnggaran <b>nama</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('tanggal_masuk') }}</label>
    <div>
        {{ Form::text('tanggal_masuk', $keuKuasaPenggunaAnggaran->tanggal_masuk, ['class' => 'form-control' .
        ($errors->has('tanggal_masuk') ? ' is-invalid' : ''), 'placeholder' => 'Tanggal Masuk']) }}
        {!! $errors->first('tanggal_masuk', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuKuasaPenggunaAnggaran <b>tanggal_masuk</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('asal') }}</label>
    <div>
        {{ Form::text('asal', $keuKuasaPenggunaAnggaran->asal, ['class' => 'form-control' .
        ($errors->has('asal') ? ' is-invalid' : ''), 'placeholder' => 'Asal']) }}
        {!! $errors->first('asal', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuKuasaPenggunaAnggaran <b>asal</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('perihal') }}</label>
    <div>
        {{ Form::text('perihal', $keuKuasaPenggunaAnggaran->perihal, ['class' => 'form-control' .
        ($errors->has('perihal') ? ' is-invalid' : ''), 'placeholder' => 'Perihal']) }}
        {!! $errors->first('perihal', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuKuasaPenggunaAnggaran <b>perihal</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('lampiran') }}</label>
    <div>
        {{ Form::text('lampiran', $keuKuasaPenggunaAnggaran->lampiran, ['class' => 'form-control' .
        ($errors->has('lampiran') ? ' is-invalid' : ''), 'placeholder' => 'Lampiran']) }}
        {!! $errors->first('lampiran', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuKuasaPenggunaAnggaran <b>lampiran</b> instruction.</small>
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
            </div>
        </div>
    </div>
