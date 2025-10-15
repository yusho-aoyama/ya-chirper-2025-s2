<x-app-layout>

    <x-slot name="header" class="flex flex-row flex-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
        <p>
            <a href="{{ route('users.create') }}">New User</a>
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <article class="my-0">
                    <header class="bg-gray-500 text-gray-50 text-lg px-4 py-2">
                        <h5>
                            {{ __('Create New User') }}
                        </h5>
                    </header>

                    <section>

                        <form method="POST"
                              class="my-4 gap-4 px-4 flex flex-col text-gray-800"
                              action="{{ route('users.store') }}">

                            @csrf

                            <!--- THE FORM FIELD BLOCKS WILL GO HERE -->
                            {{-- The name field --}}
                            <div class="flex flex-col">
                                <x-input-label for="name" :value="__('Name')"/>

                                <x-text-input id="name" class="block mt-1 w-full"
                                              type="text"
                                              name="name"
                                              :value="old('name')"
                                              required autofocus autocomplete="name"/>

                                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                            </div>
                            {{-- The Email field --}}
                            <div class="flex flex-col">
                                <x-input-label for="Email" :value="__('Email')"/>
                                <x-text-input id="Email" class="block mt-1 w-full"
                                              type="text"
                                              name="email"
                                              :value="old('email')"
                                              required autofocus autocomplete="email"/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>

                                {{-- The password field --}}
                                <x-input-label for="Password" :value="__('Password')"/>
                                <x-text-input id="Password" class="block mt-1 w-full"
                                              type="text"
                                              name="password"
                                              required autofocus />
                                <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                                {{-- The password confirmation field --}}
                                <x-input-label for="Password_Confirmation" :value="__('Confirm Password')"/>
                                <x-text-input id="Password_Confirmation" class="block mt-1 w-full"
                                              type="text"
                                              name="password_confirmation"
                                              required autofocus />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                            </div>

                            {{-- The Role field --}}
                            <div class="flex flex-row gap-6  ">

                                <a href="{{ route('users.index') }}"
                                   class="bg-gray-100 hover:bg-blue-500
                                            text-blue-800 hover:text-gray-100 text-center
                                            border border-gray-300
                                            transition ease-in-out duration-300
                                            p-2 min-w-24 rounded">
                                    <i class="fa-solid fa-times inline-block"></i>
                                    {{ __('Cancel') }}
                                </a>

                                <button type="submit"
                                        class="bg-gray-100 hover:bg-green-500
                                                text-green-800 hover:text-gray-100 text-center
                                                border border-gray-300
                                                transition ease-in-out duration-300
                                                p-2 min-w-32 rounded">
                                    <i class="fa-solid fa-save text-sm"></i>
                                    {{ __('Save') }}
                                </button>
                            </div>
                            {{-- Buttons --}}
                        </form>

                    </section>
                </article>

            </div>
        </div>
    </div>
</x-app-layout>
