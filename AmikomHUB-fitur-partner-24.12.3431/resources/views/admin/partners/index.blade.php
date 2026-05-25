@extends('layouts.admin')

@section('title', 'Partner - Admin')
@section('page_title', 'Kelola Partner')
@section('page_subtitle', 'Daftar seluruh partner.')

@section('content')

<div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h2 class="text-2xl font-black text-slate-800">
                Data Partner
            </h2>

            <p class="text-slate-500 mt-1">
                Kelola seluruh partner yang terdaftar
            </p>

        </div>

        <a href="/admin/partners/create"
           class="px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">

            + Tambah Partner

        </a>

    </div>
{{-- Search --}}
<form method="GET" action="" class="mb-8">

    <div class="flex gap-4">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari partner..."
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
                        Logo
                    </th>

                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Nama Partner
                    </th>

                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Created At
                    </th>

                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($partners as $partner)

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        {{-- Logo --}}
                        <td class="py-5 px-4">

                            <img
                                src="{{ $partner->logo_url }}"
                                alt="{{ $partner->name }}"
                                class="w-16 h-16 rounded-2xl object-cover border border-slate-100"
                            >

                        </td>

                        {{-- Name --}}
                        <td class="py-5 px-4">

                            <h5 class="font-bold text-slate-800">
                                {{ $partner->name }}
                            </h5>

                            <p class="text-sm text-slate-500 mt-1">
                                ID #{{ $partner->id }}
                            </p>

                        </td>

                        {{-- Date --}}
                        <td class="py-5 px-4 text-slate-600 font-medium">

                            {{ $partner->created_at->format('d M Y') }}

                        </td>

                        {{-- Action --}}
<td class="py-5 px-4 flex gap-3">

    {{-- Edit --}}
    <a href="/admin/partners/edit/{{ $partner->id }}"
       class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 font-bold hover:bg-yellow-200 transition">

        Edit

    </a>

    {{-- Delete --}}
    <form
        action="{{ route('partners.destroy', $partner->id) }}"
        method="POST">

        @csrf
        @method('DELETE')

        <button
            onclick="return confirm('Yakin ingin menghapus partner ini?')"
            class="px-4 py-2 rounded-xl bg-red-100 text-red-700 font-bold hover:bg-red-200 transition">

            Hapus

        </button>

    </form>

</td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center py-20">

                            <img
                                src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png"
                                class="w-28 mx-auto mb-4"
                            >

                            <h4 class="text-xl font-bold text-slate-700">
                                Belum Ada Partner
                            </h4>

                            <p class="text-slate-500 mt-2">
                                Tambahkan partner pertama Anda
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection