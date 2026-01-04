@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <p>You are logged in!</p>
        
        <div class="mt-6 p-4 bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-700 rounded">
            Welcome back, {{ Auth::user()->name }}!
        </div>
    </div>
</div>
@endsection
