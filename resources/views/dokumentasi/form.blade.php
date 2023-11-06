<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('title') }}</label>
    <div>
        {{ Form::text('title', $dokumentasi->title, ['class' => 'form-control' .
        ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('type') }}</label>
    <div>
        {{ Form::select('type', ['link' => 'Link', 'file' => 'File'], $dokumentasi->type, ['class' => 'form-control' .
        ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('link') }}</label>
    <div>
        {{ Form::text('link', $dokumentasi->link, ['class' => 'form-control' .
        ($errors->has('link') ? ' is-invalid' : ''), 'placeholder' => 'Link']) }}
        {!! $errors->first('link', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
        </div>
    </div>
</div>