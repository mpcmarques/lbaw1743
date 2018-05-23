
@if (isset($errors) && $errors->has($name))

<input id="{{$name}}" type="{{$type or 'text'}}" name="{{$name}}" value="{{ $value or old($name) }}" required class="form-control is-invalid">

<span class="invalid-feedback">

{{ $errors->first($name) }}

</span>

@else

<input id="{{$name}}" type="{{$type or 'text'}}" name="{{$name}}" value="{{ $value or old($name) }}" required class="form-control">

@endif
