@extends('layouts.dashboard')


@section('title', 'Import Data Masyarakat')
@section('content')
    <form action="{{ route('import.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="p-5 flex justify-between">
            <h6 class=" text-lg text-gray-500 font-semibold">Import Data Masyarakat</h6>
            <div class="block">
                <a href="{{ route('masyarakat.index') }}" type="button"
                    class="py-2 px-6 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-blue-600 text-blue-600 hover:border-blue-600 hover:text-white hover:bg-blue-600">
                    Back
                </a>
                <a href="https://docs.google.com/spreadsheets/d/1yj0gf6DjbflPZEYhcWJdCWSc_OFaBCWg/edit?usp=drive_link&ouid=115728741197452971675&rtpof=true&sd=true"
                    type="button"
                    class="py-2 px-7 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-transparent bg-teal-500 text-white hover:bg-teal-600">
                    Template Excel
                </a>
            </div>
        </div>
        <div class="mb-6">
            <label for="file" class="block text-sm mb-2 text-gray-400">Upload *</label>
            <input type="file" name="file" id="file"
                class="py-3 border px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                required accept=".xlsx">
            @error('file')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-sm shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Submit
            </button>
        </div>
    </form>
@endsection
