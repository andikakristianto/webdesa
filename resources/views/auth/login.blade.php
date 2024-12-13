@extends('layouts.main')

@section('title', 'Login Page')
@section('content')
    <!-- component -->
    <div class="bg-sky-100 flex justify-center items-center h-screen">
        <!-- Left: Image -->

        <!-- Right: Login Form -->
        <div class= "lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
            <h1 class="text-2xl font-semibold mb-4">Login</h1>
            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <!-- Username Input -->
                <div class="mb-4 bg-sky-100">
                    <label for="nik" class="block text-gray-600">NIK</label>
                    <input type="text" id="nik" name="nik"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off">
                </div>
                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-800">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off">
                </div>
                <!-- Remember Me Checkbox -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="remembe_token" name="remembe_token" class="text-red-500">
                    <label for="remembe_token" class="text-green-900 ml-2">Remember Me</label>
                </div>
                <!-- Forgot Password Link -->
                {{-- <div class="mb-6 text-blue-500">
                    <a href="#" class="hover:underline">Forgot Password?</a>
                </div> --}}
                <!-- Login Button -->
                <button type="submit"
                    class="bg-red-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Login</button>
            </form>
        </div>
        <div class="w-1/2 h-screen hidden lg:block">
            <img src="{{ asset('assets/images/imgsondakan.png') }}" alt="Placeholder Image"
                class="object-cover w-full h-full">
        </div>
    </div>
@endsection
