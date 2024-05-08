<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center overflow-hidden shadow-sm sm:rounded-sm">
                <div class="flex items-center justify-center w-1/2 bg-gray-300 text-gray-800 px-6 py-12 text-xl mx-1 rounded-md shadow-md">
                    <div class="flex items-center justify-center w-1/2 bg-black text-gray-200 p-6 rounded-sm">
                        Pida a domicilio
                    </div>
                </div>
                <div class="flex items-center min-h-svh justify-center w-1/2 bg-black text-gray-200 p-6 py-12 text-xl mx-1 rounded-md shadow-md">
                    <div class="flex items-center justify-center w-1/2 bg-gray-300 text-gray-800 p-6 rounded-sm">
                        <a href="{{ route('table.index') }}">Reserve una mesa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
