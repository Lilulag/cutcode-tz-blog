@extends('layout.app')

@section('title', 'Статьи')

@section('content')
    @include('partials.header')
    <main class="py-16 lg:py-20">
        <div class="container">
            <h1 class="text-[26px] sm:text-xl xl:text-[48px] 2xl:text-2xl font-black">
                Лучшие статьи
            </h1>

            <div class="tasks grid gap-4 grid-cols-1 lg:grid-cols-2 gap-x-10 gap-y-14 xl:gap-y-20 mt-12 md:mt-20">
                <div class="tasks-card flex flex-col rounded-3xl md:rounded-[40px] bg-card">
                    <div class="tasks-card-photo overflow-hidden h-40 xs:h-48 sm:h-[280px] rounded-3xl md:rounded-[40px]">
                        <a href="article.html">
                            <img src="images/article_demo.jpg"
                                 class="object-cover w-full h-full"
                                 alt="">
                        </a>
                    </div>
                    <div class="grow flex flex-col pt-6 sm:pt-10 pb-6 sm:pb-10 2xl:pb-14 px-5 sm:px-8 2xl:px-12">
                        <h3 class="text-md md:text-lg 2xl:text-xl font-black">Заголовок статьи</h3>
                        <div class="mt-auto">
                            <div class="flex flex-wrap gap-3 mt-7">
                                <a href="#"
                                   class="grow xs:grow-0 py-2 px-4 rounded-[32px] bg-[#2A2B4E] text-white no-underline text-xxs sm:text-xs font-semibold whitespace-nowrap">
                                    Категория 1
                                </a>
                            </div>
                            <div class="flex flex-wrap sm:items-center justify-center sm:justify-between mt-8 sm:mt-10">
                                <a class="btn btn-pink" href="article.html">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('partials.footer')
@endsection
