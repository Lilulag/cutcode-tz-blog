@extends('layouts.app')

@section('title', 'Статьи')

@section('content')

    <main class="py-16 lg:py-20">
        <div class="container m-auto">
            <img class="w-full rounded-xl my-8" src="/storage/images/{{$article->img}}" alt="{{ $article->title }}">

            <div class="prose prose-lg min-w-full prose-img:rounded-xl prose-invert">
                <h1 class="text-[26px] sm:text-xl xl:text-[48px] 2xl:text-2xl font-black">
                    {{ $article->title }}
                </h1>
                <div class="flex flex-wrap gap-3 mt-7">
                    <a href="#"
                       class="grow xs:grow-0 py-2 px-4 rounded-[32px] bg-[#2A2B4E] text-white no-underline text-xxs sm:text-xs font-semibold whitespace-nowrap">
                        {{ $article->category->name }}
                    </a>
                </div>

                <div class="mt-4 break-words">
                    <p> {{ $article->content }} </p>
                    <p class="mt-2 text-xs italic text-right"> Автор: {{ $article->author }} </p>
                    <p class="mt-2 text-xs text-right"> Ссылка на источник: <a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a> </p>
                </div>
            </div>
        </div>
    </main>

@endsection
