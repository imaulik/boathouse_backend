@php
  $placeholder = isset($placeholder) ? $placeholder : '';
  $class = isset($class) ? $class : '';
  $parent_class = isset($parent_class) ? $parent_class : '';
  $other = isset($other) ? $other : '';
@endphp
<div class="form-group {{$parent_class}}">
  <label for="{{$name}}">{{$label}}</label>
  <textarea class="form-control {{$class}} {{ $errors->has($name) ? ' is-invalid' : '' }}"
            id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}"{{$other}}>{{$value}}</textarea>
  @if ($errors->has($name))
    <span class="invalid-feedback">{{ isset($error_msg)?$error_msg:$errors->first($name) }}</span>
  @endif
</div>
