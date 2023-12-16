<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <main class="bg-darkblue text-white md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
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
                <h1 class="mb-5 text-lg font-semibold">Восстановить пароль</h1>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-text-input id="email" placeholder="E-mail"
                                      class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/10 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-gray-600 text-xxs md:text-xs font-semibold"
                                      type="email" name="email" :value="old('email')"
                                      required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <button class="w-full btn btn-pink" type="submit">Отправить</button>
                </form>

                <div class="space-y-3 mt-5">
                    <div class="text-xxs md:text-xs flex justify-end">
                        <a class="text-gray-600 hover:text-gray-900 font-bold"
                           href="{{ route("login") }}"
                        >
                            Я вспомнил пароль
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-guest-layout>
