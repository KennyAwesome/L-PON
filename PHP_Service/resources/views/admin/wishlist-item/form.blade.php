<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('image_url') ? 'has-error' : ''}}">
    {!! Form::label('image_url', 'Image Url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('image_url', null, ['class' => 'form-control']) !!}
        {!! $errors->first('image_url', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('product_url') ? 'has-error' : ''}}">
    {!! Form::label('product_url', 'Product Url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('product_url', null, ['class' => 'form-control']) !!}
        {!! $errors->first('product_url', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
