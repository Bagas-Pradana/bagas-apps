@include('partials.header')
{{-- Navigation Panel --}}
<div class="bg-gray-100 flex flex-wrap items-center justify-between px-8 w-full">
    <h1 class="text-4xl font-bold font-serif text-cyan-500 w-[20%] text-left justify-self-start py-2">Bagas</h1>
    <div class="w-[80%%] flex justify-evenly gap-x-8 py-2">
        <a href="{{ route('home') }}"><span class="{{ $hidup === 'home' ? 'underline underline-offset-8 decoration-red-800 decoration-4' : '' }}text-blue-400 text-2xl font-bold font-sans">Home</span></a>
        <a href="{{ route('about') }}"><span class="{{ $hidup === 'about' ? 'underline underline-offset-8 decoration-red-800 decoration-4' : '' }}text-blue-400 text-2xl font-bold font-sans">About</span></a>
        <a href="{{ route('blog') }}"><span class="{{ $hidup === 'blog' ? 'underline underline-offset-8 decoration-red-800 decoration-4' : '' }}text-blue-400 text-2xl font-bold font-sans ">Blog</span></a>
        <a href="{{ route('categories') }}"><span class="{{ $hidup === 'categories' ? 'underline underline-offset-8 decoration-red-800 decoration-4' : '' }}text-blue-400 text-2xl font-bold font-sans ">Categories</span></a>
        <a href="{{ route('userlist') }}"><span class="{{ $hidup === 'userlist' ? 'underline underline-offset-8 decoration-red-800 decoration-4' : '' }}text-blue-400 text-2xl font-bold font-sans ">Users</span></a>
        <a href="{{ route('dashboard') }}"><span class="{{ $hidup === 'dashboard' ? 'underline underline-offset-8 decoration-amber-800 decoration-4' : '' }}text-amber-400 text-2xl font-bold font-sans "></span></a>

        @auth
        {{-- Jika Sudah Login --}}
         <!-- Bungkus tombol dan dropdown dalam satu container relative -->
         <div class="relative">
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                {{-- @dd(auth()) --}} {{ auth()->user()->name }}
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <!-- Dropdown menu: posisikan secara absolute sehingga muncul di bawah tombol -->
            <div id="dropdown" class="absolute top-full left-0 mt-2 z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                    </li>
                    <li>
                        <form action="/logout" method="POST">
                                @csrf
                            <button type="submit" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        @else
        {{-- Jika Belum Login --}}
        <a href="{{ route('login') }}"><span class="{{ $hidup === 'login' ? 'underline underline-offset-8 decoration-amber-800 decoration-4' : '' }}text-amber-400 text-2xl font-bold font-sans ">Login</span></a>

        @endauth

    </div>
</div>

@include('partials.footer')
