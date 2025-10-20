<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-row justify- w-full" >
            <h2 class="font-semibold text-xl text-gray-800 leading-tight grow">
                {{ __('Users') }}
            </h2>

            <div class="flex flex-row items-center gap-2">
                <a href="{{ route('users.create') }}"
                   class="flex items-center gap-1 text-green-800 bg-gray-200 border
                   border-gray-300 rounded-lg px-4 py-1 hover:bg-green-800 hover:text-white
                   transition">
                    <i class="fa-solid fa-user-plus"></i>
                    New User
                </a>

                <form action="{{ route('users.index') }}" method="GET" class="flex flex-row gap-0">
                    <x-text-input id="search"
                                  type="text"
                                  name="search"
                                  class="border border-gray-200 rounded-r-none shadow-transparent"
                                  :value="$search??''"
                    />

                    <button type="submit"
                            class="flex items-center gap-1 text-green-800 bg-gray-200 border-gray-300
                             rounded-lg px-4 py-1 rounded-l-none hover:bg-green-800 hover:text-white transition">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </button>
                </form>
            </div>
        </div>

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

                                {{-- The Role field --}}
                                <x-input-label for="Role" :value="__('Role')"/>
                                <select id="Role"
                                        class="block mt-1 w-full px-2 py-1 border-gray-300
            focus:outline-indigo-500 focus:outline-2 focus:ring-2 focus:ring-indigo-500              rounded-md shadow-sm"        type="text"
                                        name="role"
                                        :value="old('role')"
                                        required autofocus autocomplete="role">
                                    <option>
                                        Role will be implemented with Roles & Permissions
                                    </option>
                                </select>

                                <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                            </div>


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

                                {{-- Buttons --}}
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

                        </form>

                    </section>
                </article>

            </div>
        </div>
    </div>
</x-app-layout>
