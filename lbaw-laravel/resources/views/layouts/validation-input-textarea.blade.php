
@if (isset($errors) && $errors->has($name))

<textarea id="{{$name}}" name="{{$name}}" rows="{{ $rows }}" required class="form-control is-invalid">{{ $value or old($name) }}</textarea>

<span class="invalid-feedback">

{{ $errors->first($name) }}

</span>

@else

<textarea id="{{$name}}" name="{{$name}}" rows="{{ $rows }}" required class="form-control">{{ $value or old($name) }}</textarea>

@endif
