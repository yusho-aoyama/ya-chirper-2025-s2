<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-row justify-between w-full">
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
                            {{ __('Details for') }}
                            <em>{{ $user->name }}</em>
                        </h5>
                    </header>
                    {{-- Name --}}
                    <section class="px-4 flex flex-col text-gray-800">
                        <div class="grid grid-rows-3 mt-6 ">
                            <p class="text-gray-500 text-sm ">Name:</p>
                            <p class="w-full ml-4">
                                {{ $user->name ?? "No Name provided" }}
                            </p>
                        </div>
                    </section>
                    {{-- Email --}}
                    <div class="grid grid-rows-3  ">
                        <p class="text-gray-500 text-sm ">Email:</p>
                        <p class="w-full ml-4">
                            {{ $user->email ?? "No Email Provided" }}
                        </p>
                    </div>
                    {{-- Role --}}
                    <div class="grid grid-rows-3  ">
                        <p class="text-gray-500 text-sm ">Role:</p>
                        <p class="w-full ml-4">
                            {{ $user->role ?? "No Role Provided" }}
                        </p>
                    </div>
                    {{-- Added and last updated --}}
                    <div class="grid grid-rows-3  ">
                        <p class="text-gray-500 text-sm ">Created at:</p>
                        <p class="w-full ml-4">
                            {{ $user->created_at->format('j M Y') }}
                        </p>
                    </div>

                    <div class="grid grid-rows-3  ">
                        <p class="text-gray-500 text-sm ">Updated at:</p>
                        <p class="w-full ml-4">
                            {{ $user->updated_at->format('j M Y') }}
                        </p>
                    </div>
                    <!-- Only Admin and Staff access these options -->
                    <form method="POST"
                          class="flex my-8 gap-6 ml-4"
                          action="{{ route('users.destroy', $user) }}">

                        @csrf
                        @method('delete')
                        <!-- All user button -->
                        <a href="{{ route('users.index', $user) }}"
                           class="bg-gray-100 hover:bg-blue-500
                                  text-blue-800 hover:text-gray-100 text-center
                                  border border-gray-300
                                  transition ease-in-out duration-300
                                  p-2 min-w-24 rounded">
                            <i class="fa-solid fa-user inline-block"></i>
                            {{ __('All Users') }}
                        </a>
                        <!-- Edit button -->
                        <a href="{{ route('users.edit', $user) }}"
                           class="bg-gray-100 hover:bg-amber-500
                                  text-amber-800 hover:text-gray-100 text-center
                                  border border-gray-300
                                  transition ease-in-out duration-300
                                  p-2 min-w-24 rounded">
                            <i class="fa-solid fa-user-edit text-sm"></i>
                            {{ __('Edit') }}
                        </a>
                        <!-- Delete button -->
                        <button type="submit"
                                class="bg-gray-100 hover:bg-red-500
                                       text-red-800 hover:text-gray-100
                                       text-center
                                       border border-gray-300
                                       transition ease-in-out duration-300
                                       p-2 min-w-16 rounded">
                            <i class="fa-solid fa-user-minus text-sm"></i>
                            {{ __('Delete') }}
                        </button>
                    </form>
                    <!-- /Only Admin and Staff access these options -->
                </article>

            </div>
        </div>
    </div>
</x-app-layout>
