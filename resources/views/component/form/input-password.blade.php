@php
  $placeholder = isset($placeholder) ? $placeholder : '';
  $other = isset($other) ? $other : '';
  $parent_class = isset($parent_class) ? $parent_class : '';
  $class = isset($class) ? $class : '';
@endphp
<div class="form-group {{$parent_class}} {{ $errors->has($name) ? ' has-error' : '' }}">
  <label for="{{$name}}">{{$label}}</label>
  <input type="password" class="form-control {{$class}} "
         id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}" {{$other}}>
  @if ($errors->has($name))
    <span class="help-block">{{ isset($error_msg)?$error_msg:$errors->first($name) }}</span>
  @endif
</div>
