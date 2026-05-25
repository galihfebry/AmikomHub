@extends('layouts.admin')

@section('title', 'Categories - Admin')
@section('page_title', 'Kelola Categories')
@section('page_subtitle', 'Daftar seluruh kategori.')

@section('content')

<div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h2 class="text-2xl font-black text-slate-800">
                Data Categories
            </h2>

            <p class="text-slate-500 mt-1">
                Kelola seluruh kategori event
            </p>

        </div>

        {{-- Button Modal --}}
        <button
            onclick="document.getElementById('addModal').classList.remove('hidden')"
            class="px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">

            + Tambah Category

        </button>

    </div>
{{-- Search --}}
<form method="GET" action="" class="mb-8">

    <div class="flex gap-4">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari category..."
            class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">

        <button
            type="submit"
            class="px-6 py-4 bg-slate-800 text-white rounded-2xl font-bold">

            Cari

        </button>

    </div>

</form>
    {{-- Success Alert --}}
    @if(session('success'))

        <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-700 font-medium">

            {{ session('success') }}

        </div>

    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b border-slate-100">

                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">
                        ID
                    </th>

                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Nama Category
                    </th>

                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Slug
                    </th>

                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Created At
                    </th>

                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        {{-- ID --}}
                        <td class="py-5 px-4">

                            <span class="font-bold text-slate-700">
                                #{{ $category->id }}
                            </span>

                        </td>

                        {{-- Name --}}
                        <td class="py-5 px-4">

                            <h5 class="font-bold text-slate-800">
                                {{ $category->name }}
                            </h5>

                        </td>

                        {{-- Slug --}}
                        <td class="py-5 px-4">

                            <span class="px-4 py-2 rounded-full bg-slate-100 text-slate-700 text-sm font-semibold">

                                {{ $category->slug }}

                            </span>

                        </td>

                        {{-- Date --}}
                        <td class="py-5 px-4 text-slate-600 font-medium">

                            {{ $category->created_at->format('d M Y') }}

                        </td>

                        {{-- Action --}}
                        <td class="py-5 px-4 flex gap-3">

                            {{-- Edit --}}
                            <button
                                onclick="document.getElementById('editModal{{ $category->id }}').classList.remove('hidden')"
                                class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 font-bold hover:bg-yellow-200 transition">

                                Edit

                            </button>

                            {{-- Delete --}}
                            <form
                                action="{{ route('categories.destroy', $category->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus category ini?')"
                                    class="px-4 py-2 rounded-xl bg-red-100 text-red-700 font-bold hover:bg-red-200 transition">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    {{-- EDIT MODAL --}}
                    <div
                        id="editModal{{ $category->id }}"
                        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                        <div class="bg-white w-full max-w-md p-8 rounded-[2rem]">

                            <h3 class="text-2xl font-black text-slate-800 mb-6">
                                Edit Category
                            </h3>

                            <form
                                action="{{ route('categories.update', $category->id) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <div class="mb-5">

                                    <label class="block mb-2 font-bold text-slate-700">
                                        Nama Category
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ $category->name }}"
                                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                                </div>

                                <div class="flex justify-end gap-3">

                                    <button
                                        type="button"
                                        onclick="document.getElementById('editModal{{ $category->id }}').classList.add('hidden')"
                                        class="px-5 py-3 rounded-2xl bg-slate-100 font-bold text-slate-700">

                                        Batal

                                    </button>

                                    <button
                                        type="submit"
                                        class="px-5 py-3 rounded-2xl bg-indigo-600 text-white font-bold">

                                        Update

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-20">

                            <img
                                src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png"
                                class="w-28 mx-auto mb-4"
                            >

                            <h4 class="text-xl font-bold text-slate-700">
                                Belum Ada Category
                            </h4>

                            <p class="text-slate-500 mt-2">
                                Tambahkan category pertama Anda
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ADD MODAL --}}
<div
    id="addModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div class="bg-white w-full max-w-md p-8 rounded-[2rem]">

        <h3 class="text-2xl font-black text-slate-800 mb-6">
            Tambah Category
        </h3>

        <form
            action="{{ route('categories.store') }}"
            method="POST">

            @csrf

            <div class="mb-5">

                <label class="block mb-2 font-bold text-slate-700">
                    Nama Category
                </label>

                <input
                    type="text"
                    name="name"
                    placeholder="Masukkan nama category"
                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">

            </div>

            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="document.getElementById('addModal').classList.add('hidden')"
                    class="px-5 py-3 rounded-2xl bg-slate-100 font-bold text-slate-700">

                    Batal

                </button>

                <button
                    type="submit"
                    class="px-5 py-3 rounded-2xl bg-indigo-600 text-white font-bold">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection