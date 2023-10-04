
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nama') }}</label>
    <div>
        {{ Form::text('nama', $keuPejabatPengadaan->nama, ['class' => 'form-control' .
        ($errors->has('nama') ? ' is-invalid' : ''), 'placeholder' => 'Nama']) }}
        {!! $errors->first('nama', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuPejabatPengadaan <b>nama</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('tanggal_masuk') }}</label>
    <div>
        {{ Form::text('tanggal_masuk', $keuPejabatPengadaan->tanggal_masuk, ['class' => 'form-control' .
        ($errors->has('tanggal_masuk') ? ' is-invalid' : ''), 'placeholder' => 'Tanggal Masuk']) }}
        {!! $errors->first('tanggal_masuk', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuPejabatPengadaan <b>tanggal_masuk</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('asal') }}</label>
    <div>
        {{ Form::text('asal', $keuPejabatPengadaan->asal, ['class' => 'form-control' .
        ($errors->has('asal') ? ' is-invalid' : ''), 'placeholder' => 'Asal']) }}
        {!! $errors->first('asal', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuPejabatPengadaan <b>asal</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('perihal') }}</label>
    <div>
        {{ Form::text('perihal', $keuPejabatPengadaan->perihal, ['class' => 'form-control' .
        ($errors->has('perihal') ? ' is-invalid' : ''), 'placeholder' => 'Perihal']) }}
        {!! $errors->first('perihal', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuPejabatPengadaan <b>perihal</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('lampiran') }}</label>
    <div>
        {{ Form::text('lampiran', $keuPejabatPengadaan->lampiran, ['class' => 'form-control' .
        ($errors->has('lampiran') ? ' is-invalid' : ''), 'placeholder' => 'Lampiran']) }}
        {!! $errors->first('lampiran', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuPejabatPengadaan <b>lampiran</b> instruction.</small>
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
