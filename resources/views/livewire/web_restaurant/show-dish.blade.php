<div>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-14 space-y-4">
            <div class="flex justify-center items-center">
                <div class="radio-inputs">
                    <label class="radio">
                        <input type="radio" value='appetizer' wire:click='searchDishes' wire:model='typeFilter' name="radio">
                        <span class="name">Entrantes</span>
                    </label>
                    <label class="radio">
                        <input type="radio" value='main_course' wire:click='searchDishes' wire:model='typeFilter' name="radio">
                        <span class="name">Platos Principales</span>
                    </label>
                    <label class="radio">
                        <input type="radio" value='dessert' wire:click='searchDishes' wire:model='typeFilter' name="radio">
                        <span class="name">Postres</span>
                    </label>
                    <label class="radio">
                        <input type="radio" value='drink' wire:click='searchDishes' wire:model='typeFilter' name="radio">
                        <span class="name">Bebidas</span>
                    </label>
                </div>
            </div>
            <div class="bg-gray-200 rounded-md shadow-md p-4 flex flex-wrap justify-center items-center gap-4">
                @foreach($dishes as $dish)
                    <div class="card-container shadow-md flex-1 min-w-[calc(50%-1rem)] max-w-[calc(50%-1rem)]">
                        <div class="card">
                            <div class="img-content">
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{$dish->description}}">
                            </div>
                            <div class="content p-4 bg-black rounded-md">
                                <p class="heading font-bold">{{$dish->name}}</p>
                                <p>
                                    Precio: {{$dish->price}} €
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
