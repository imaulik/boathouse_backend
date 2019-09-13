@php
  $class = isset($class) ? $class : '';
  $parent_class = isset($parent_class) ? $parent_class : '';
  $other = isset($other) ? $other : '';
@endphp
<div class="form-group {{$parent_class}}">
  <label class="d-block">{{$label}}</label>
  @foreach($items as $index => $item)
    <div class="form-group custom-control custom-radio {{$class}} ">
      <input type="radio" id="{{$name.'_'.$index}}"
             name="{{$name}}" value="{{$item['value']}}"
             class="custom-control-input {{ $errors->has($name) ? ' is-invalid' : '' }}"
             @if($value==$item['value']) checked="checked" @endif {{$other}}>
      <label class="custom-control-label" for="{{$name.'_'.$index}}">{{$item['label']}}</label>
    </div>
  @endforeach
  @if ($errors->has($name))
    <span class="invalid-feedback d-block">{{ isset($error_msg)?$error_msg:$errors->first($name) }}</span>
  @endif
</div>
