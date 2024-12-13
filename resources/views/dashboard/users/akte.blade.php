@extends('layouts.dashboard')

@section('title', 'Layanan Akte')

@section('content')
    <div class="card mt-5 mb-5 bg-white shadow-md rounded-lg">
        <div class="card-title">
            <h2 class="text-2xl font-bold text-center py-4">Form Pembuatan Akte</h2>
        </div>
        <div class="card-body p-6">
            <form action="{{ route('layananakte.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="status" value="sending">

                <!-- Nama -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm mb-2 text-gray-400">Nama *</label>
                    <input type="text" name="nama" id="nama"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}" required>
                    @error('nama')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- KK -->
                <div class="mb-6">
                    <label for="kk" class="block text-sm mb-2 text-gray-400">Nomor Kartu Keluarga</label>
                    <input type="text" name="kk" id="kk"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="Masukkan Nomor KK" value="{{ old('kk') }}">
                    @error('kk')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIK -->
                <div class="mb-6">
                    <label for="nik" class="block text-sm mb-2 text-gray-400">NIK </label>
                    <input type="text" name="nik" id="nik"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="Masukkan NIK" value="{{ old('nik') }}">
                    @error('nik')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div class="mb-6">
                    <label for="jeniskelamin" class="block text-sm mb-2 text-gray-400">Jenis Kelamin *</label>
                    <select name="jeniskelamin" id="jeniskelamin"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="laki" {{ old('jeniskelamin') == 'laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('jeniskelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                    @error('jeniskelamin')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-6">
                    <label for="tempatlahir" class="block text-sm mb-2 text-gray-400">Tempat Lahir *</label>
                    <input type="text" name="tempatlahir" id="tempatlahir"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="Masukkan Tempat Lahir" value="{{ old('tempatlahir') }}" required>
                    @error('tempatlahir')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="agama" class="block text-sm mb-2 text-gray-400">Agama *</label>
                    <input type="text" name="agama" id="agama"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="Masukkan Agama" value="{{ old('agama') }}" required>
                    @error('agama')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="tanggallahir" class="block text-sm mb-2 text-gray-400">Tanggal Lahir *</label>
                    <input type="date" name="tanggallahir" id="tanggallahir"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        value="{{ old('tanggallahir') }}" required>
                    @error('tanggallahir')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Dokumen -->
                <div class="mb-6">
                    <label for="files" class="block text-sm mb-2 text-gray-400">Upload Dokumen *</label>
                    <input type="file" name="files" id="files"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        required>
                    @error('files')
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
