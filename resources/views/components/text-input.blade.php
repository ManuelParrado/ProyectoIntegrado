<div class="form__group field">
    <input id="{{$label ?? $slot}}" {!! $attributes->merge(['class' => 'form__field']) !!} placeholder="{{$value ?? $slot}}" required="">
    <label for="{{$label ?? $slot}}" class="form__label">{{$label ?? $slot}}</label>
</div>


