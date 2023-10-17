
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('keu_surat_masuk_id') }}</label>
    <div>
        {{ Form::text('keu_surat_masuk_id', $keuDisposisi->keu_surat_masuk_id, ['class' => 'form-control' .
        ($errors->has('keu_surat_masuk_id') ? ' is-invalid' : ''), 'placeholder' => 'Keu Surat Masuk Id']) }}
        {!! $errors->first('keu_surat_masuk_id', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuDisposisi <b>keu_surat_masuk_id</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('tanggal_disposisi') }}</label>
    <div>
        {{ Form::text('tanggal_disposisi', $keuDisposisi->tanggal_disposisi, ['class' => 'form-control' .
        ($errors->has('tanggal_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Tanggal Disposisi']) }}
        {!! $errors->first('tanggal_disposisi', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuDisposisi <b>tanggal_disposisi</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('batas_waktu_tindaklanjuti') }}</label>
    <div>
        {{ Form::text('batas_waktu_tindaklanjuti', $keuDisposisi->batas_waktu_tindaklanjuti, ['class' => 'form-control' .
        ($errors->has('batas_waktu_tindaklanjuti') ? ' is-invalid' : ''), 'placeholder' => 'Batas Waktu Tindaklanjuti']) }}
        {!! $errors->first('batas_waktu_tindaklanjuti', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuDisposisi <b>batas_waktu_tindaklanjuti</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('jenis_disposisi') }}</label>
    <div>
        {{ Form::text('jenis_disposisi', $keuDisposisi->jenis_disposisi, ['class' => 'form-control' .
        ($errors->has('jenis_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Jenis Disposisi']) }}
        {!! $errors->first('jenis_disposisi', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuDisposisi <b>jenis_disposisi</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('status_disposisi') }}</label>
    <div>
        {{ Form::text('status_disposisi', $keuDisposisi->status_disposisi, ['class' => 'form-control' .
        ($errors->has('status_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Status Disposisi']) }}
        {!! $errors->first('status_disposisi', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuDisposisi <b>status_disposisi</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('komentar') }}</label>
    <div>
        {{ Form::text('komentar', $keuDisposisi->komentar, ['class' => 'form-control' .
        ($errors->has('komentar') ? ' is-invalid' : ''), 'placeholder' => 'Komentar']) }}
        {!! $errors->first('komentar', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">keuDisposisi <b>komentar</b> instruction.</small>
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
