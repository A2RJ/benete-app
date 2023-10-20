<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('tujuan') }}</label>
    <div>
        {{ Form::text('tujuan', $pelabuhanDisposisi->tujuan, ['class' => 'form-control' .
        ($errors->has('tujuan') ? ' is-invalid' : ''), 'placeholder' => 'Tujuan Disposisi']) }}
        {!! $errors->first('tujuan', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('batas_waktu_tindaklanjuti') }}</label>
    <div>
        {{ Form::date('batas_waktu_tindaklanjuti', $pelabuhanDisposisi->batas_waktu_tindaklanjuti, ['class' => 'form-control' .
        ($errors->has('batas_waktu_tindaklanjuti') ? ' is-invalid' : ''), 'placeholder' => 'Batas Waktu Tindaklanjuti']) }}
        {!! $errors->first('batas_waktu_tindaklanjuti', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('jenis_disposisi') }}</label>
    <div>
        {{ Form::select('jenis_disposisi', ['Segera' => 'Segera', 'Biasa' => 'Biasa'], $pelabuhanDisposisi->jenis_disposisi, ['class' => 'form-control' .
        ($errors->has('jenis_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Jenis Disposisi']) }}
        {!! $errors->first('jenis_disposisi', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('status_disposisi') }}</label>
    <div>
        {{ Form::select('status_disposisi', ['Belum Ditindaklanjuti' => 'Belum Ditindaklanjuti', 'Selesai' => 'Selesai', 'Terlewati' => 'Terlewati'], $pelabuhanDisposisi->status_disposisi, ['class' => 'form-control' .
        ($errors->has('status_disposisi') ? ' is-invalid' : ''), 'placeholder' => 'Status Disposisi']) }}
        {!! $errors->first('status_disposisi', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('catatan') }}</label>
    <div>
        {{ Form::textarea('catatan', $pelabuhanDisposisi->catatan, ['class' => 'form-control' .
        ($errors->has('catatan') ? ' is-invalid' : ''), 'placeholder' => 'Catatan']) }}
        {!! $errors->first('catatan', '<div class="invalid-feedback">:message</div>') !!}
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