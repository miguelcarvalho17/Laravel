@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }} Your Jobs ({{ $jobs->count()}})</div>
        <div class="card-body">
            @foreach($jobs as $job)
                <a
                    href="{{ route('showJob', $job->title) }}"
                >
                    <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($job->logo)) }}" alt="logotipo" Height="250" width="250"></img>
                    </div>
                    <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
                        <h2 class="text-xl font-bold text-gray-900 title-font mb-1">{{ $job->title }}</h2>
                        <p class="leading-relaxed text-gray-900">
                            {{ $job->company }} &mdash; <span class="text-gray-600">{{ $job->location }}</span>
                        </p>
                    </div>
                    <span class="md:flex-grow flex items-center justify-end">
                        <span>{{ $job->created_at->diffForHumans() }}</span>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
@endsection
