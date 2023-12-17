@extends('layouts.app')

@section('title', 'Статьи')

@section('content')

    <main class="py-16 lg:py-20">
        <div class="container m-auto">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        @if(!empty($articles))
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Заголовок
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Текст
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Изображение
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Автор
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Создан
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Действия</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach($articles as $article)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $article->title }}
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $article->content }}
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($article->imageUrl)
                                                    <img class="rounded-full h-20 w-20 object-cover" src="{{ $article->imageUrl }}" />
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $article->author }}
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $article->created_at }}
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 flex">
                                                    <a class="text-indigo-600 hover:text-indigo-900"
                                                       href="{{ route('admin.articles.edit', $article) }}"
                                                    >Редактировать</a>
                                                    <form method="post" action="{{ route('admin.articles.destroy', $article) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="ml-2 text-red-600 hover:text-red-900 cursor-pointer">
                                                            Удалить
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div>{{ $articles->links('vendor.pagination.tailwind') }}</div>
                            </div>

                        @else
                            <div class="text-center font-bold text-xl">
                                Статей пока нет
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
