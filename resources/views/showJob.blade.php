@extends('layouts.template')
@section ('title')
    Find Job
@endsection
@section ('content')

    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="mb-12">
                <h2 class="text-2xl font-medium text-gray-900 title-font">
                    {{ $job->title }}
                </h2>
            </div>
            <div class="-my-6">
                <div class="flex flex-wrap md:flex-nowrap">
                    <div class="content w-full md:w-3/4 pr-4 leading-relaxed text-base">
                        {!! $job->content !!}
                    </div>
                    <div class="w-full md:w-1/4 pl-4">
                        <img
                            src="/storage/{{ $job->logo }}"
                            alt="{{ $job->company }} logo"
                            class="max-w-full mb-4"
                        >
                        <p class="leading-relaxed text-base">
                            <strong>Location: </strong>{{ $job->location }}<br>
                            <strong>Company: </strong>{{ $job->company }}
                        </p>
                        <a class="btn btn-dark" href={{ route('applyJob', $job->title) }}" role="button">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
