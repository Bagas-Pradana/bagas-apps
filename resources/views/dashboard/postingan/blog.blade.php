@extends('layouts.dashboard-main')

@section('title', 'dashboard')

@section('dash-content')
<!-- component -->
<section class="absolute top-0 w-[75%] right-0 z-10 pt-4">
    <div class="flex flex-col gap-y-6 w-[75%] ps-4 ">
        <h1 class="mx-auto font-bold text-2xl pl-4">My Postingan</h1>
        <form action="" class=" max-w-full">
            <div class="flex flex-wrap py-8 w-[95%] justify-start">
                <input type="text" value="{{ request('key') }}" id="first_name" name="key" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg block w-[40%] p-2" placeholder="Pencarian"/>
                <button type="submit" name="klik" value="1" id="klik" class="py-[0.3rem] px-3 font-bold bg-blue-600 inline-block w-fit rounded-r-lg text-white">Cari</button>
            </div>
        </form>
        <a href="/dashboard/blog/create" class="self-start text-xl font-semibold px-3 pt-0.5 pb-1 bg-blue-600 inline-flex items-center gap-2 rounded-lg text-white">Create New Post</a>
        @if(session()->has('success'))
            <div class="text-green-600 bg-white bg-opacity-70 font-bold p-1">{{ session('success') }}</div>
        @endif
    </div>


    <div class="relative overflow-x-auto p-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Judul
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-4 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postingan as $hasil)

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $hasil->judul }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $hasil->category->nama_kategory }}
                    </td>
                    <td class="">
                        <div class="flex flex-wrap gap-1 justify-center">
                            <a href="/dashboard/blog/{{ $hasil->slug }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-5 w-5">
                                    <path fill-rule="evenodd" d="M6.912 3a3 3 0 00-2.868 2.118l-2.411 7.838a3 3 0 00-.133.882V18a3 3 0 003 3h15a3 3 0 003-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0017.088 3H6.912zm13.823 9.75l-2.213-7.191A1.5 1.5 0 0017.088 4.5H6.912a1.5 1.5 0 00-1.434 1.059L3.265 12.75H6.11a3 3 0 012.684 1.658l.256.513a1.5 1.5 0 001.342.829h3.218a1.5 1.5 0 001.342-.83l.256-.512a3 3 0 012.684-1.658h2.844z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <form action="/dashboard/blog/{{ $hasil->slug }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" onclick="return confirm('Yakin?')">
                                    <svg class="text-gray-400 dark:text-gray-500 w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                </button>
                            </form>
                            <a href="/dashboard/blog/{{ $hasil->slug }}/edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>

@endsection
