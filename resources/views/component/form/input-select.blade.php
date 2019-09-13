@php
  $class = isset($class) ? $class : '';
  $parent_class = isset($parent_class) ? $parent_class : '';
  $other = isset($other) ? $other : '';
  $value = isset($value) ? $value : null;
  $unselectable = isset($unselectable) ? $unselectable : false;
  if (isset($option_value)){
      $options = \App\Models\SelectMaster::where('name',$option_value)->with('options')->first()->toArray();
  }else{
     $option_value = null;
     $options = [];
  }

@endphp
<div class="form-group {{$parent_class}}">
  <label for="{{$name}}">@lang($label)</label>
  <select class="custom-select {{$class}} {{ $errors->has(str_replace(array('[',']'),'',$name)) ? ' is-invalid' : '' }}"
          id="{{$name}}" name="{{$name}}" {!! $other !!}>
    @if($unselectable)
      <option selected value="">@lang($unselectable)</option>
    @endif
    @if(isset($option_value))
      @foreach($options['options'] as $option)
        @if($option['id'] == $value)
          <option value="{{$option['id']}}" selected>{{$option['value']}}</option>
        @else
          <option value="{{$option['id']}}">{{$option['value']}}</option>
        @endif
      @endforeach
    @else
      {{ $slot }}
    @endif
  </select>
  @if ($errors->has($name))
    <span class="invalid-feedback">{{ isset($error_msg)?$error_msg:$errors->first($name) }}</span>
  @endif
</div>
