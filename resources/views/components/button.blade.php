<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex gradient2 items-center px-4 py-2 rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-gray-900 hover:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
