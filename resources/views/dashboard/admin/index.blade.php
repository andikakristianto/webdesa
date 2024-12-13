@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body flex flex-col gap-6">
            <div class="flex justify-between">
                <h6 class="text-lg text-gray-500 font-semibold">Dashboard {{ Auth::user()->name }}</h6>
            </div>
        </div>
    </div>
@endsection
