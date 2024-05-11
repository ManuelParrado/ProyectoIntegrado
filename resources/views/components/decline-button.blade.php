<button {{ $attributes->merge(['class' => 'py-2.5 px-5 ms-3 text-sm text-center font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 transition duration-150 hover:scale-105  hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-400']) }}>
    {{ $slot }}
</button>
