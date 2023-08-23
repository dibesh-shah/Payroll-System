@extends('layouts.master')
@section('content')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    @if(session('success'))
    <div class="text-green-500 mb-4">
        {{ session('success') }}
    </div>
      @endif
   </div>
</div>

@endsection
