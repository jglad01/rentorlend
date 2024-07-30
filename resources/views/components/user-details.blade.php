@props(['user'])

<div class="text-lg my-4">
    <span>{{ $user->name }}
        @if ($user->avatar)
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="" class="ml-2 w-12 aspect-square inline rounded-full">
        @endif

        @if ($user->getUserRating() != 0)
            <i class="fa fa-star star-checked ml-2"></i> {{ $user->getUserRating() }}
        @endif
    </span>
    @auth
        @if ($user->id != auth()->user()->id)
            <p class="rating-container">
                <span class="mr-2">Rate this user!</span>
                <i data-rating-value="1" class="fa fa-star rating-star"></i>
                <i data-rating-value="2" class="fa fa-star rating-star"></i>
                <i data-rating-value="3" class="fa fa-star rating-star"></i>
                <i data-rating-value="4" class="fa fa-star rating-star"></i>
                <i data-rating-value="5" class="fa fa-star rating-star"></i>
                <form class="rating-submit inline" method="POST" action="/rate/user/{{ $user->id }}">
                    @csrf
                    <input type="hidden" id="rating-value" name="rating-value" value="0">
                    <button class="block bg-denim1 mt-2 p-2 text-white rounded-xl hover:opacity-80 inline">Submit</button>
                </form>
            </p>
        @endif
    @endauth
</div>