@php
  $placeholder = isset($placeholder) ? $placeholder : '';
  $class = isset($class) ? $class : '';
  $other = isset($other) ? $other : '';
  $parent_class = isset($parent_class) ? $parent_class : '';
@endphp
<div class="form-group {{$parent_class}} {{ $errors->has($name) ? '  has-error' : '' }}">
  <label for="{{$name}}">{{$label}}</label>
  <input type="email" class="form-control {{$class}}"
         id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}"
         value="{{$value}}" {{$other}}>
  @if ($errors->has($name))
    <span class="help-block">{{ isset($error_msg)?$error_msg:$errors->first($name) }}</span>
  @endif
</div>
