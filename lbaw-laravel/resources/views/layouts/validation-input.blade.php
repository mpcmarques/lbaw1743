
@if (isset($errors) && $errors->has($name))

<input id="{{$name}}" type="{{$type or 'text'}}" name="{{$name}}" value="{{ $value or old($name) }}" placeholder="{{ $preview or '' }}" class="form-control is-invalid" required>

<span class="invalid-feedback">

{{ $errors->first($name) }}

</span>

@else

<input id="{{$name}}" type="{{$type or 'text'}}" name="{{$name}}" value="{{ $value or old($name) }}" placeholder="{{ $preview or '' }}" class="form-control" required>

@endif
