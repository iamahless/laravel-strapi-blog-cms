@extends('layout.main')

@section('content')
<div class="relative bg-white px-6 pt-16 pb-20 lg:px-8 lg:pt-24 lg:pb-28">
    <div class="absolute inset-0">
        <div class="h-1/3 bg-white sm:h-2/3"></div>
    </div>
    <div class="relative mx-auto max-w-7xl">
        <div class="text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Journal</h2>
            <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">Experiences with minimalism.</p>
        </div>
        <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
            @foreach ($posts as $post)
            <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                <div class="flex-shrink-0">
                    <img class="h-48 w-full object-cover"
                        src="{{ config('blogapi.asset_url').$post->attributes->coverImage->data->attributes->formats->small->url}}"
                        alt="{{ $post->attributes->title }}">
                </div>
                <div class="flex flex-1 flex-col justify-between bg-white p-6">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-indigo-600">
                            <a href="#" class="hover:underline">{{
                                $post->attributes->categories->data[0]->attributes->name ?? 'Uncategorised' }}</a>
                        </p>
                        <a href="{{ route('post.show',['postId'=> $post->id.'-'.$post->attributes->slug]) }}"
                            class="mt-2 block">
                            <p class="text-xl font-semibold text-gray-900">{{ $post->attributes->title }}</p>
                            <p class="mt-3 text-base text-gray-500">{{ $post->attributes->excerpt }}</p>
                        </a>
                    </div>
                    <div class="mt-6 flex items-center">
                        <div class="flex-shrink-0">
                            <a href="#">
                                <span class="sr-only">Roel Aufderehar</span>
                                <img class="h-10 w-10 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </a>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">
                                <a href="#" class="hover:underline">Roel Aufderehar</a>
                            </p>
                            <div class="flex space-x-1 text-sm text-gray-500">
                                <time datetime="2020-03-16">Mar 16, 2020</time>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>


@endsection