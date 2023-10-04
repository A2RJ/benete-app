<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('nama') }}</label>
    <div>
        {{ Form::text('nama', $keuSuratMasuk->nama, [
            'class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : ''),
            'placeholder' => 'Nama',
        ]) }}
        {!! $errors->first('nama', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuSuratMasuk <b>nama</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('tanggal_masuk') }}</label>
    <div>
        {{ Form::text('tanggal_masuk', $keuSuratMasuk->tanggal_masuk, [
            'class' => 'form-control' . ($errors->has('tanggal_masuk') ? ' is-invalid' : ''),
            'placeholder' => 'Tanggal Masuk',
        ]) }}
        {!! $errors->first('tanggal_masuk', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuSuratMasuk <b>tanggal_masuk</b> instruction.</small>
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
        <small class="form-hint">keuSuratMasuk <b>asal</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('perihal') }}</label>
    <div>
        {{ Form::text('perihal', $keuSuratMasuk->perihal, [
            'class' => 'form-control' . ($errors->has('perihal') ? ' is-invalid' : ''),
            'placeholder' => 'Perihal',
        ]) }}
        {!! $errors->first('perihal', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuSuratMasuk <b>perihal</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('lampiran') }}</label>
    <div>
        {{ Form::text('lampiran', $keuSuratMasuk->lampiran, [
            'class' => 'form-control' . ($errors->has('lampiran') ? ' is-invalid' : ''),
            'placeholder' => 'Lampiran',
        ]) }}
        {!! $errors->first('lampiran', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuSuratMasuk <b>lampiran</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('disposisi') }}</label>
    <div>
        {{ Form::text('disposisi', $keuSuratMasuk->disposisi, [
            'class' => 'form-control' . ($errors->has('disposisi') ? ' is-invalid' : ''),
            'placeholder' => 'Disposisi',
        ]) }}
        {!! $errors->first('disposisi', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuSuratMasuk <b>disposisi</b> instruction.</small>
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
