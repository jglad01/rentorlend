@if (session()->has('message'))
    <div id="session-message" class="z-50 opacity-80 fixed top-0 left-1/3 transition-transform bg-denim0 text-white px-48 py-3">
        <p>{{ session('message') }}</p>
    </div>
@endif
