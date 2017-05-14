<div class="form-group {{ $errors->has('sl_gender') ? 'has-error' : ''}}">
    {!! Form::label('sl_gender', 'Sl Gender', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('sl_gender', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sl_gender', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sl_min_price') ? 'has-error' : ''}}">
    {!! Form::label('sl_min_price', 'Sl Min Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('sl_min_price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sl_min_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sl_max_price') ? 'has-error' : ''}}">
    {!! Form::label('sl_max_price', 'Sl Max Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('sl_max_price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sl_max_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sl_color') ? 'has-error' : ''}}">
    {!! Form::label('sl_color', 'Sl Color', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('sl_color', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sl_color', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sl_occasion') ? 'has-error' : ''}}">
    {!! Form::label('sl_occasion', 'Sl Occasion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('sl_occasion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sl_occasion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sl_style') ? 'has-error' : ''}}">
    {!! Form::label('sl_style', 'Sl Style', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('sl_style', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sl_style', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('wg_age') ? 'has-error' : ''}}">
    {!! Form::label('wg_age', 'Wg Age', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('wg_age', null, ['class' => 'form-control']) !!}
        {!! $errors->first('wg_age', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('wg_min_price') ? 'has-error' : ''}}">
    {!! Form::label('wg_min_price', 'Wg Min Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('wg_min_price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('wg_min_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('wg_max_price') ? 'has-error' : ''}}">
    {!! Form::label('wg_max_price', 'Wg Max Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('wg_max_price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('wg_max_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('wg_date_from') ? 'has-error' : ''}}">
    {!! Form::label('wg_date_from', 'Wg Date From', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('wg_date_from', null, ['class' => 'form-control']) !!}
        {!! $errors->first('wg_date_from', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('wg_date_to') ? 'has-error' : ''}}">
    {!! Form::label('wg_date_to', 'Wg Date To', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('wg_date_to', null, ['class' => 'form-control']) !!}
        {!! $errors->first('wg_date_to', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('wg_city_id') ? 'has-error' : ''}}">
    {!! Form::label('wg_city_id', 'Wg City Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('wg_city_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('wg_city_id', '<p class="help-block">:message</p>') !!}
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
