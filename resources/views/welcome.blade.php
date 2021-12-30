@extends('layouts.template')
@section ('title')
Find Job
@endsection
@section ('content')
<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
    <form>
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://www.pcguia.pt/wp-content/uploads/2021/11/Microsoft.jpg" class="d-block w-100" alt="Oracle Company">
            </div>
            <div class="carousel-item">
                <img src="https://tm.ibxk.com.br/2019/10/18/18180753819133.jpg?ims=1200x675" class="d-block w-100" alt="Microsoft Brand">
            </div>
            <div class="carousel-item">
                <img src="https://allvectorlogo.com/img/2016/04/jetbrains-logo.png" class="d-block w-100" alt="JetBrains Logo">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="position:relative;right:15%;"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="position:relative;left:15%;"></span>
            <span class="sr-only">Next</span>
        </a>
</div>
<div class="mb-12">
    <h2 class="text-2xl font-medium text-gray-900 title-font px-4">All jobs ({{ $jobs->count() }})</h2>
</div>
<div class="-my-6">
    @foreach($jobs as $job)
        <a
            href="{{ route('showJob', $job->title) }}"
        >
            <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
                <img src="/storage/{{ $job->logo }}" alt="{{ $job->company }} logo" class="w-16 h-16 rounded-full object-cover">
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
</form>
@endsection
