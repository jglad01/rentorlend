@props(['review'])
@php($author = $review->getReviewAuthor())

<div class="bg-gray-50 border border-gray-200 rounded p-6 my-4">
    <div class="flex">
        <div>
            <div class="text-xl mb-4">
                @isset($review->comment)
                    {{ $review->comment }} 
                @endisset
                <i class="fa fa-star star-checked ml-2"></i> {{ $review->rate_value }} </div>
            <div class="text-lg mt-4">
                @if ($author->avatar)
                    <img src="{{ asset('storage/' . $author->avatar) }}" alt="" class="mr-2 w-12 aspect-square inline rounded-full">
                @endif
                
                {{ $author->name }}
            </div>
        </div>
        @if ($review->uid == auth()->id())
            <div class="self-center mr-0 ml-auto">
                <form method="POST" action="/reviews/{{ $review->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500"><i class="fa-solid fa-trash mr-2"></i>Delete</button>
                </form>
            </div>
        @endif
    </div>
</div>