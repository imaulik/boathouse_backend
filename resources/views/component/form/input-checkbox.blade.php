@php
  $other = isset($other) ? $other : '';
  $class = isset($class) ? $class : '';
  $parent_class = isset($parent_class) ? $parent_class : '';
@endphp
<div class="form-group custom-control custom-checkbox {{$parent_class}}">
  <input type="checkbox" class="custom-control-input {{$class}} {{ $errors->has($name) ? ' is-invalid' : '' }}"
         id="{{$name}}" name="{{$name}}"
         @isset($checkbox_value) value="{{$checkbox_value}}" {{$value == $checkbox_value ? 'checked' : ''}} @else {{$value ? 'checked' : ''}} @endisset
      {{$other}} >
  <label class="custom-control-label" for="{{$name}}">{{$label}}</label>
  @if ($errors->has($name))
    <span class="invalid-feedback">{{ isset($error_msg)?$error_msg:$errors->first($name) }}</span>
  @endif
</div>
