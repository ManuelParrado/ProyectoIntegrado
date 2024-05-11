<div class="form__group field">
    <input id="{{$value ?? $slot}}" {!! $attributes->merge(['class' => 'form__field']) !!} placeholder="{{$value ?? $slot}}" required="">
    <label for="{{$value ?? $slot}}" class="form__label">{{$value ?? $slot}}</label>
</div>


