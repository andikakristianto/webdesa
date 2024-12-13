@extends('layouts.dashboard')

@section('title', 'Layanan Regist KK')

@section('content')
    <div class="card mt-5 mb-5 bg-white shadow-md rounded-lg">
        <div class="card-title">
            <h2 class="text-2xl font-bold text-center py-4">Form Edit Regist Pembuatan Kartu Tanda Penduduk</h2>
        </div>
        <div class="card-body p-6">
            <form action="{{ route('layananktp.updatestore', [$ktp->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="status" value="sending">
                <div class="mb-6">
                    <label for="namalengkap" class="block text-sm mb-2 text-gray-400">Nama Lengkap *</label>
                    <input type="text" name="namalengkap" id="namalengkap"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="" required value="{{ old('namalengkap', $ktp->namalengkap) }}">
                    @error('namalengkap')
                        <p class="text-sm  text-red-500 opacity-75 mt-2" id="hs-input-helper-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="nik" class="block text-sm mb-2 text-gray-400">NIK</label>
                    <input type="text" name="nik" id="nik"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="" required value="{{ old('nik', $ktp->nik) }}">
                    @error('nik')
                        <p class="text-sm  text-red-500 opacity-75 mt-2" id="hs-input-helper-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="kewarganegaraan" class="block text-sm mb-2 text-gray-400">Kewarganegaraan *</label>
                    <select name="kewarganegaraan" id="kewarganegaraan"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        required>
                        <option value="" disabled
                            {{ old('kewarganegaraan', $ktp->kewarganegaraan) == null ? 'selected' : '' }}>Pilih
                            Kewarganegaraan</option>
                        <option value="wni"
                            {{ old('kewarganegaraan', $ktp->kewarganegaraan) == 'wni' ? 'selected' : '' }}>WNI</option>
                        <option value="wna"
                            {{ old('kewarganegaraan', $ktp->kewarganegaraan) == 'wna' ? 'selected' : '' }}>WNA</option>
                    </select>
                    @error('kewarganegaraan')
                        <p class="text-sm text-red-500 mt-2" id="hs-input-helper-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="jeniskelamin" class="block text-sm mb-2 text-gray-400">Jenis Kelamin *</label>
                    <select name="jeniskelamin" id="jeniskelamin"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        required>
                        <option value="" disabled
                            {{ old('jeniskelamin', $ktp->jeniskelamin) == null ? 'selected' : '' }}>Pilih Jenis
                            Kelamin</option>
                        <option value="laki" {{ old('jeniskelamin', $ktp->jeniskelamin) == 'laki' ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="perempuan"
                            {{ old('jeniskelamin', $ktp->jeniskelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                    @error('jeniskelamin')
                        <p class="text-sm text-red-500 mt-2" id="hs-input-helper-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="tempatlahir" class="block text-sm mb-2 text-gray-400">Tempat Lahir *</label>
                    <input type="text" name="tempatlahir" id="tempatlahir"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="" required value="{{ old('tempatlahir', $ktp->tempatlahir) }}">
                    @error('tempatlahir')
                        <p class="text-sm  text-red-500 opacity-75 mt-2" id="hs-input-helper-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="tanggallahir" class="block text-sm mb-2 text-gray-400">Tanggal Lahir *</label>
                    <input type="text" name="tanggallahir" id="tanggallahir"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="" required value="{{ old('tanggallahir', $ktp->tanggallahir) }}">
                    @error('tanggallahir')
                        <p class="text-sm  text-red-500 opacity-75 mt-2" id="hs-input-helper-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="agama" class="block text-sm mb-2 text-gray-400">Agama *</label>
                    <input type="text" name="agama" id="agama"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="" required value="{{ old('agama', $ktp->agama) }}">
                    @error('agama')
                        <p class="text-sm  text-red-500 opacity-75 mt-2" id="hs-input-helper-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="alamat" class="block text-sm mb-2 text-gray-400">Alamat *</label>
                    <input type="text" name="alamat" id="alamat"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="" required value="{{ old('alamat', $ktp->alamat) }}">
                    @error('alamat')
                        <p class="text-sm  text-red-500 opacity-75 mt-2" id="hs-input-helper-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="pekerjaan" class="block text-sm mb-2 text-gray-400">Pekerjaan *</label>
                    <input type="text" name="pekerjaan" id="pekerjaan"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="" required value="{{ old('pekerjaan', $ktp->pekerjaan) }}">
                    @error('pekerjaan')
                        <p class="text-sm  text-red-500 opacity-75 mt-2" id="hs-input-helper-text">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="statuskawin" class="block text-sm mb-2 text-gray-400">Status Kawin *</label>
                    <select name="statuskawin" id="statuskawin"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        required>
                        <option value="" disabled selected>Pilih Status Kawin</option>
                        <option value="lajang" {{ old('statuskawin', $ktp->statuskawin) == 'lajang' ? 'selected' : '' }}>
                            Lajang</option>
                        <option value="menikah"
                            {{ old('statuskawin', $ktp->statuskawin) == 'menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="cerai" {{ old('statuskawin', $ktp->statuskawin) == 'cerai' ? 'selected' : '' }}>
                            Cerai</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="files" class="block text-sm mb-2 text-gray-400">Upload Dokumen *</label>
                    <input type="file" name="files" id="files"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        value="{{ old('files') }}">
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
