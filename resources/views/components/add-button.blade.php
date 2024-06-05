<button id='add-button' {{ $attributes->merge(['type' => 'submit', 'class' => 'noselect']) }}>
    <span class="text">{{$slot}}</span>
    <span class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
        </svg>
    </span>
</button>
