@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <main class="py-16 lg:py-20 grow">
        <div class="container mx-auto">

            <div class="md:flex-col md:items-start md:justify-between md:space-x-4">

                @if (in_array(session('status'), ['password-updated', 'profile-updated']))
                    <p class="max-w-[640px] mt-4 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple mb-5">
                        Изменения сохранены
                    </p>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="max-w-[640px] mt-4 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple mb-5">
                            {{$error}}
                        </p>
                    @endforeach
                @endif

                <div class="md:w-1/2 md:my-0 my-4 w-full p-2 xs:p-4 md:p-8 2xl:p-12 rounded-[20px] bg-purple">
                    <div id="changeToggler" class="p-4 cursor-pointer rounded-md"
                         onclick="toggleChangeForm()"> Редактировать профиль</div>
                    <div id="changePasswordToggler" class="p-4 cursor-pointer rounded-md"
                         onclick="toggleChangePasswordForm()"> Изменить пароль</div>
                </div>

                <div class="w-full p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
                    <form method="post" action="{{ route('profile.avatar.store') }}"
                          class="space-y-3 hidden"
                          enctype="multipart/form-data"
                          id="saveAvatarForm">
                        @csrf
                        <input type="file" class="hidden" name="avatar" id="avatarInput" onchange="uploadAvatar()">
                    </form>

                    <form method="post" action="{{ route('profile.avatar.delete') }}"
                          class="space-y-3 hidden"
                          id="deleteAvatarForm">
                        @csrf

                    </form>

                    <form method="post" action="{{ route('profile.update') }}"
                          class="space-y-3 @if ((!Session::has('status') || session('status') === 'profile-updated') || session('status') === 'password-updated')) hidden @endif"
                          id="changeForm">
                        @csrf
                        @method('patch')

                        <div class="flex items-center justify-between">
                            <div>
                                <div class="mt-2"><img
                                        src="{{ (session('status') === 'avatar-changed' && auth()->user()->lastAvatarUrl) ? auth()->user()->lastAvatarUrl : auth()->user()->avatarUrl ?? '' }}"
                                        alt="" class="rounded-full h-20 w-20 object-cover"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <button onclick="clickUploadAvatarInput()" class="w-full btn btn-pink mt-2 mr-2" type="button"> Загрузить</button>
                                <button onclick="clickDeleteAvatar()" class="w-full btn btn-outline mt-2" type="button"> Удалить</button>
                            </div>
                        </div>

                        <input class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                               type="text"
                               required=""
                               name="name"
                               value="{{ $user->name ?? old("name") ?? '' }}"
                               placeholder="Имя">

                        <input class="mt-4 w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                               type="email"
                               name="email"
                               required=""
                               value="{{ $user->email ?? old("email") ?? '' }}"
                               placeholder="E-mail"
                        >

                        <button class="mt-4 w-full btn btn-pink" type="submit"> Сохранить</button>
                    </form>
                    <form action="{{ route('password.update') }}" method="post" class="space-y-3 hidden" id="changePasswordForm">
                        @csrf
                        @method('put')

                        <input class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                               type="password"
                               required=""
                               name="current_password"
                               autocomplete="current-password"
                               placeholder="Текущий пароль"
                        >

                        <input
                            class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                            type="password" required="" autocomplete="new-password" placeholder="Новый пароль"
                            name="password"
                        >

                        <input
                            class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                            type="password" required="" autocomplete="new-password" placeholder="Повторите пароль"
                            name="password_confirmation"
                        >

                        <button class="w-full btn btn-pink" type="submit"> Сменить пароль</button>

                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection
@section('js')
    <script>
        const changeForm = document.getElementById('changeForm');
        const changeToggler = document.getElementById('changeToggler');

        const toggleChangeForm = () => {
            changePasswordForm.classList.add('hidden');
            changeForm.classList.toggle('hidden');
            changeToggler.classList.toggle('bg-pink');
            changePasswordToggler.classList.remove('bg-pink');
        }

        const changePasswordForm = document.getElementById('changePasswordForm');
        const changePasswordToggler = document.getElementById('changePasswordToggler');

        const toggleChangePasswordForm = () => {
            changeForm.classList.add('hidden');
            changePasswordForm.classList.toggle('hidden');
            changePasswordToggler.classList.toggle('bg-pink');
            changeToggler.classList.remove('bg-pink');
        }

        const avatarInput = document.getElementById('avatarInput');
        const saveAvatarForm = document.getElementById('saveAvatarForm');
        const deleteAvatarForm = document.getElementById('deleteAvatarForm');

        const clickUploadAvatarInput = () => {
            avatarInput.click();
        }
        const uploadAvatar = () => {
            saveAvatarForm.submit();
        }
        const clickDeleteAvatar = () => {
            deleteAvatarForm.submit();
        }
    </script>
@endsection
