@extends('layouts.dashboard')

@section('title', 'Edit Profile')


@section('content')
    <div class="card">
        <div class="p-5 flex justify-between">
            <h6 class=" text-lg text-gray-500 font-semibold">Edit Profile</h6>
            <a href="{{ route('dashboard') }}" type="button"
                class="py-2 px-6 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-blue-600 text-blue-600 hover:border-blue-600 hover:text-white hover:bg-blue-600">
                Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('profileupdate') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="role" value="user" id=""> --}}
                @method('PUT')
                @if ($user->role === 'admin')
                    <div class="mb-6">
                        <label for="name" class="block text-sm mb-2 text-gray-400">Nama Lengkap *</label>
                        <input type="text" name="name" id="name"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Masukkan Nama Lengkap...." value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="mb-6">
                        <label for="name" class="block text-sm mb-2 text-gray-400">Nama Lengkap *</label>
                        <input readonly type="text" name="name" id="name"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Masukkan Nama Lengkap...." value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                <div class="mb-6">
                    <label for="email" class="block text-sm mb-2 text-gray-400">Email *</label>
                    <input type="email" name="email" id="email"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="Masukan Email Anda" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                {{-- <div class="mb-6">
                    <label for="password" class="block text-sm mb-2 text-gray-400">Password *</label>
                    <input type="password" name="password" id="password"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                    @error('password')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div> --}}
                @if ($user->role === 'admin')
                    <div class="mb-6">
                        <label for="nik" class="block text-sm mb-2 text-gray-400">NIK </label>
                        <input type="text" name="nik" id="nik"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Masukkan NIK Anda (Opsional)" value="{{ old('nik', $user->nik) }}">
                        @error('nik')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="mb-6">
                        <label for="nik" class="block text-sm mb-2 text-gray-400">NIK </label>
                        <input readonly type="text" name="nik" id="nik"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Masukkan NIK Anda (Opsional)" value="{{ old('nik', $user->nik) }}">
                        @error('nik')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                @if ($user->role === 'admin')
                    <div class="mb-6">
                        <label for="kk" class="block text-sm mb-2 text-gray-400">Kartu Keluarga (KK) </label>
                        <input type="text" name="kk" id="kk"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Masukkan KK Anda (Opsional)" value="{{ old('kk', $user->kk) }}">
                        @error('kk')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="mb-6">
                        <label for="kk" class="block text-sm mb-2 text-gray-400">Kartu Keluarga (KK) </label>
                        <input readonly type="text" name="kk" id="kk"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Masukkan KK Anda (Opsional)" value="{{ old('kk', $user->kk) }}">
                        @error('kk')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                @if ($user->role === 'admin')
                    <div class="mb-6">
                        <label for="tgl_lahir" class="block text-sm mb-2 text-gray-400">Tanggal Lahir </label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            value="{{ old('tgl_lahir', $user->tgl_lahir) }}">
                        @error('tgl_lahir')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="mb-6">
                        <label for="tgl_lahir" class="block text-sm mb-2 text-gray-400">Tanggal Lahir </label>
                        <input readonly type="date" name="tgl_lahir" id="tgl_lahir"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            value="{{ old('tgl_lahir', $user->tgl_lahir) }}">
                        @error('tgl_lahir')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                <div class="mb-6">
                    <label for="domisili" class="block text-sm mb-2 text-gray-400">Domisili </label>
                    <input type="text" name="domisili" id="domisili"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                        placeholder="Masukan Domisili Anda" value="{{ old('domisili', $user->domisili) }}">
                    @error('domisili')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                @if ($user->role === 'admin')
                    <div class="mb-6">
                        <label for="jeniskelamin" class="block text-sm mb-2 text-gray-400">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" id="jeniskelamin"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="laki"
                                {{ old('jenis_kelamin', $user->jenis_kelamin) == 'laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="perempuan"
                                {{ old('jenis_kelamin', $user->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="mb-6">
                        <label for="jeniskelamin" class="block text-sm mb-2 text-gray-400">Jenis Kelamin *</label>
                        <select aria-readonly name="jenis_kelamin" id="jeniskelamin"
                            class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option disabled value="laki"
                                {{ old('jenis_kelamin', $user->jenis_kelamin) == 'laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option disabled value="perempuan"
                                {{ old('jenis_kelamin', $user->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                <div class="mb-6">
                    <label for="profile" class="block text-sm mb-2 text-gray-400">Profile Picture *</label>
                    <input type="file" name="profile" id="profile"
                        class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                    @error('profile')
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
