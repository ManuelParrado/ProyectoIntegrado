<button {{ $attributes->merge(['class' => 'text-white bg-black hover:bg-gray-700 focus:ring-4 transition duration-150 hover:scale-105 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center']) }}>
    {{ $slot }}
</button>
