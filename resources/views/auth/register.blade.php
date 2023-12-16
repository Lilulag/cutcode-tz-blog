<x-guest-layout>

    <main class="bg-darkblue text-gray-600 md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
        <div class="container">
            <div class="text-center">
                <a rel="home" href="/">
                    <img alt="CutCode"
                         class="w-[148px] md:w-[201px] h-[36px] md:h-[50px] inline-block"
                         src="{{ asset('images/nav/logo-dark.svg') }}"
                    >
                </a>
            </div>
            <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
                <h1 class="mb-5 text-lg font-semibold">Регистрация</h1>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-text-input id="email" placeholder="E-mail"
                                      class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                                      type="email" name="email" :value="old('email')" required autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Name -->
                    <div class="mt-4">
                        <x-text-input id="name" placeholder="Имя"
                                      class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                                      type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-text-input id="password" class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                                      type="password"
                                      name="password"
                                      placeholder="Пароль"
                                      required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-text-input id="password_confirmation"
                                      class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                                      type="password"
                                      name="password_confirmation"
                                      placeholder="Повторите пароль"
                                      required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button class="w-full btn btn-pink justify-center">
                            Зарегистрироваться
                        </x-primary-button>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <div class="text-xxs md:text-xs">
                            Есть аккаунт? <a class="text-gray-600 hover:text-gray-900 font-bold underline underline-offset-4"
                               href="{{ route('login') }}">
                                Войти
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </main>
</x-guest-layout>
