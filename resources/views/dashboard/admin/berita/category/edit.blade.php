@extends('layouts.dashboard')

@section('title', 'Edit Category');


@section('content')
    <div class="card">
        <div class="card-title">
            <h2 class="p-4">Edit Category</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Name</label>
                    <input type="text" name="name" id="input-label-with-helper-text"
                        class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                        aria-describedby="hs-input-helper-text" value="{{ old('name', $category->name) }}">
                </div>
                <button class="btn text-base py-2.5 text-white font-medium w-full hover:bg-blue-700">Submit</button>
            </form>
        </div>
    </div>
@endsection
