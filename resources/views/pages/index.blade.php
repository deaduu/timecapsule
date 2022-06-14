@extends('pages.layout.body')

@section('body')

<div class="antialiased">

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">

                <img src="{{asset('logo/TimeCapsule-logos_transparent.png')}}" alt="" class="h-16 w-auto text-gray-700 sm:h-20">
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid">
                    <div id="messageArea" class="alert alert-success">

                    </div>
                </div>
            </div>

        </div>

    </div>


</div>

@endsection