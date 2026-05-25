@extends('layouts.admin')

@section('title', 'Edit Partner')

@section('content')

<div class="bg-white p-8 rounded-[2.5rem] shadow-sm">

    <h2 class="text-2xl font-black mb-8">
        Edit Partner
    </h2>

    <form
        action="{{ route('partners.update', $partner->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-6">

            <label class="block mb-2 font-bold text-slate-700">
                Nama Partner
            </label>

            <input
                type="text"
                name="name"
                value="{{ $partner->name }}"
                class="w-full px-5 py-4 rounded-2xl border border-slate-200">

        </div>

        {{-- Logo URL --}}
        <div class="mb-6">

            <label class="block mb-2 font-bold text-slate-700">
                Logo URL
            </label>

            <input
                type="text"
                name="logo_url"
                value="{{ $partner->logo_url }}"
                class="w-full px-5 py-4 rounded-2xl border border-slate-200">

        </div>

        <button
            type="submit"
            class="px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold">

            Update Partner

        </button>

    </form>

</div>

@endsection