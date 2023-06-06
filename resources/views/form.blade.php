<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/profile">
                        @csrf
                        <label for="title">Post Title</label>

                        <input id="title"
                            type="text"
                            class="@error('title') is-invalid @enderror rounded border-l-violet-200 bg-violet-100">

                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
