<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full border-black" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Kecamatan -->
            <div class="mt-4">
                <x-label for="kec" :value="__('Kecamatan')" />
                <select class="block mt-1 w-full rounded border-green-500" name="kec" id="kec">
                    <option selected="0">Pilih Kecamatan...</option>
                    @forelse ($kecs as $dc)
                    <option value="{{$dc->id}}">Kecamatan {{$dc->nama_kec}}</option>
                    @empty
                    <option value="">Data Kecamatan tidak ditemukan</option>
                    @endforelse
            </select>
            </div>

            <!-- Kelurahan -->
            <div class="mt-4">
                <x-label for="kel" :value="__('Kelurahan')" />
                <select class="block mt-1 w-full rounded col-12" name="kel" id="kel">

                </select>
            </div>

            <!-- RT -->
            <div class="mt-4">
                <x-label for="rt" :value="__('Rukun Tetangga')" />
                <select class="block mt-1 w-full rounded col-12" name="rt_id" id="rt">

                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Konfirmasi Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Mendaftar') }}
                </x-button>
            </div>
        </form>
        @include('aplikasi.dropdown')
    </x-auth-card>
</x-guest-layout>
