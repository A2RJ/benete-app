<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('bmn_surat_masuk_id') }}</label>
    <div>
        {{ Form::text('bmn_surat_masuk_id', $bmnDisposisi->bmn_surat_masuk_id, ['class' => 'form-control' .
        ($errors->has('bmn_surat_masuk_id') ? ' is-invalid' : ''), 'placeholder' => 'Bmn Surat Masuk Id']) }}
        {!! $errors->first('bmn_surat_masuk_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('tanggal_disposisi') }}</label>
    <div>
        {{ Form::text('tanggal_disposisi', $bmnDisposisi->tanggal_disposisi, ['class' => 'form-control' .
        ($errors->has('tanggal_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Tanggal Disposisi']) }}
        {!! $errors->first('tanggal_disposisi', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('batas_waktu_tindaklanjuti') }}</label>
    <div>
        {{ Form::text('batas_waktu_tindaklanjuti', $bmnDisposisi->batas_waktu_tindaklanjuti, ['class' => 'form-control' .
        ($errors->has('batas_waktu_tindaklanjuti') ? ' is-invalid' : ''), 'placeholder' => 'Batas Waktu Tindaklanjuti']) }}
        {!! $errors->first('batas_waktu_tindaklanjuti', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('jenis_disposisi') }}</label>
    <div>
        {{ Form::text('jenis_disposisi', $bmnDisposisi->jenis_disposisi, ['class' => 'form-control' .
        ($errors->has('jenis_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Jenis Disposisi']) }}
        {!! $errors->first('jenis_disposisi', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('status_disposisi') }}</label>
    <div>
        {{ Form::text('status_disposisi', $bmnDisposisi->status_disposisi, ['class' => 'form-control' .
        ($errors->has('status_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Status Disposisi']) }}
        {!! $errors->first('status_disposisi', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('komentar') }}</label>
    <div>
        {{ Form::text('komentar', $bmnDisposisi->komentar, ['class' => 'form-control' .
        ($errors->has('komentar') ? ' is-invalid' : ''), 'placeholder' => 'Komentar']) }}
        {!! $errors->first('komentar', '<div class="invalid-feedback">:message</div>') !!}
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