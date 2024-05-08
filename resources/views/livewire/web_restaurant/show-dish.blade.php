<div>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <ul>
                @foreach ($dishes as $dish)
                    <li>{{$dish->name}}</li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
