
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('pelabuhan_surat_masuk_id') }}</label>
    <div>
        {{ Form::text('pelabuhan_surat_masuk_id', $pelabuhanDisposisi->pelabuhan_surat_masuk_id, ['class' => 'form-control' .
        ($errors->has('pelabuhan_surat_masuk_id') ? ' is-invalid' : ''), 'placeholder' => 'Pelabuhan Surat Masuk Id']) }}
        {!! $errors->first('pelabuhan_surat_masuk_id', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">pelabuhanDisposisi <b>pelabuhan_surat_masuk_id</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('tanggal_disposisi') }}</label>
    <div>
        {{ Form::text('tanggal_disposisi', $pelabuhanDisposisi->tanggal_disposisi, ['class' => 'form-control' .
        ($errors->has('tanggal_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Tanggal Disposisi']) }}
        {!! $errors->first('tanggal_disposisi', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">pelabuhanDisposisi <b>tanggal_disposisi</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('batas_waktu_tindaklanjuti') }}</label>
    <div>
        {{ Form::text('batas_waktu_tindaklanjuti', $pelabuhanDisposisi->batas_waktu_tindaklanjuti, ['class' => 'form-control' .
        ($errors->has('batas_waktu_tindaklanjuti') ? ' is-invalid' : ''), 'placeholder' => 'Batas Waktu Tindaklanjuti']) }}
        {!! $errors->first('batas_waktu_tindaklanjuti', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">pelabuhanDisposisi <b>batas_waktu_tindaklanjuti</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('jenis_disposisi') }}</label>
    <div>
        {{ Form::text('jenis_disposisi', $pelabuhanDisposisi->jenis_disposisi, ['class' => 'form-control' .
        ($errors->has('jenis_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Jenis Disposisi']) }}
        {!! $errors->first('jenis_disposisi', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">pelabuhanDisposisi <b>jenis_disposisi</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('status_disposisi') }}</label>
    <div>
        {{ Form::text('status_disposisi', $pelabuhanDisposisi->status_disposisi, ['class' => 'form-control' .
        ($errors->has('status_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Status Disposisi']) }}
        {!! $errors->first('status_disposisi', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">pelabuhanDisposisi <b>status_disposisi</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('komentar') }}</label>
    <div>
        {{ Form::text('komentar', $pelabuhanDisposisi->komentar, ['class' => 'form-control' .
        ($errors->has('komentar') ? ' is-invalid' : ''), 'placeholder' => 'Komentar']) }}
        {!! $errors->first('komentar', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">pelabuhanDisposisi <b>komentar</b> instruction.</small>
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
