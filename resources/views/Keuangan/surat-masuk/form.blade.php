<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('nama surat') }}</label>
    <div>
        {{ Form::text('nama', $keuSuratMasuk->nama, [
            'class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : ''),
            'placeholder' => 'Nama Surat',
        ]) }}
        {!! $errors->first('nama', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('tanggal_masuk') }}</label>
    <div>
        {{ Form::date('tanggal_masuk', $keuSuratMasuk->tanggal_masuk, [
            'class' => 'form-control' . ($errors->has('tanggal_masuk') ? ' is-invalid' : ''),
            'placeholder' => 'Tanggal Masuk',
        ]) }}
        {!! $errors->first('tanggal_masuk', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('asal') }}</label>
    <div>
        {{ Form::text('asal', $keuSuratMasuk->asal, [
            'class' => 'form-control' . ($errors->has('asal') ? ' is-invalid' : ''),
            'placeholder' => 'Asal',
        ]) }}
        {!! $errors->first('asal', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('perihal') }}</label>
    <div>
        {{ Form::textarea('perihal', $keuSuratMasuk->perihal, [
            'class' => 'form-control' . ($errors->has('perihal') ? ' is-invalid' : ''),
            'placeholder' => 'Perihal',
        ]) }}
        {!! $errors->first('perihal', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('lampiran') }}</label>
    <div>
        {{ Form::file('lampiran', [
            'class' => 'form-control' . ($errors->has('lampiran') ? ' is-invalid' : ''),
            'placeholder' => 'Lampiran',
        ]) }}
        {!! $errors->first('lampiran', '<div class="invalid-feedback">:message</div>') !!}
        @if (is_string($keuSuratMasuk->lampiran))
        <a href="{{ $keuSuratMasuk->lampiran }}">Download file</a>
        @endif
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
        </div>
    </div>
</div>