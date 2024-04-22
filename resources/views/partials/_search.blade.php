<form action="">
    <div class="relative m-4 rounded-lg">
        <div class="absolute top-4 left-3">
            <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
        </div>
        <input type="text" id="car-search" name="search" autocomplete="off" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" placeholder="Search by make, model, year etc." value="{{ request('search') }}"/>
    </div>
    <p class="text-center">Didn't find what you want? <span class="font-bold">Try the <a href="/otodom_clone/public/advanced-search" class="text-gray-600">advanced search!</a></span></p>
</form>