@extends('layouts.dashboard')

@section('title', 'Tambah Berita')

@section('content')
    <div class="card">
        <div class="p-5 flex justify-between">
            <h6 class=" text-lg text-gray-500 font-semibold">Tambah Berita</h6>
            <a href="{{ route('berita.index') }}" type="button"
                class="py-2 px-6 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-blue-600 text-blue-600 hover:border-blue-600 hover:text-white hover:bg-blue-600">
                Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="title" class="block text-sm mb-2 text-gray-400">Judul *</label>
                    <input type="text" name="title" id="title"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="Masukkan Judul Berita" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="category_id" class="block text-sm mb-2 text-gray-400">Kategori *</label>
                    <select name="category_id" id="category_id"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="content" class="block text-sm mb-2 text-gray-400">Konten *</label>
                    <textarea name="content" id="content" rows="5"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="Masukkan Konten Berita" required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="thumbnail" class="block text-sm mb-2 text-gray-400">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                    @error('thumbnail')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="published_at" class="block text-sm mb-2 text-gray-400">Tanggal Publikasi</label>
                    <input type="date" name="published_at" id="published_at"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        value="{{ old('published_at') }}">
                    @error('published_at')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="status" class="block text-sm mb-2 text-gray-400">Status *</label>
                    <select name="status" id="status"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        required>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
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
        </div>
    </div>
@endsection
