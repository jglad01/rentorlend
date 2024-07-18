@if (session()->has('message'))
    <div id="session-message" class="z-50 opacity-80 fixed top-0 left-0 lg:left-1/3 transition-transform bg-denim0 text-white p-2.5 w-full lg:w-auto text-center lg:px-48 lg:py-3">
        <p>{{ session('message') }}</p>
    </div>
@endif
