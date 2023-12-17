<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

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
                <h1 class="mb-5 text-lg text-gray-600 font-semibold">Вход в admin-аккаунт</h1>

                <form method="POST" action="{{ route('admin.login') }}" class="space-y-3">
                    @csrf

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-text-input id="email"
                                      placeholder="E-mail"
                                      class="block mt-1 w-full w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                                      type="email" name="email"
                                      :value="old('email')" required autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')"
                                       class="mt-3 text-pink text-xxs xs:text-xs"
                        />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-text-input id="password" class="block mt-1 w-full w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 placeholder:text-gray-600 text-xxs md:text-xs font-semibold"
                                      type="password" name="password"
                                      placeholder="Пароль"
                                      required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button class="w-full btn btn-pink justify-center">
                            Войти
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-guest-layout>
