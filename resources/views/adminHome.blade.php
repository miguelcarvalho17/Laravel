@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} All Users ({{ $users->count()}})</div>
                <div class="card-body">
                    @foreach($users as $user)
                            <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
                                <h2 class="text-xl font-bold text-gray-900 title-font mb-1">{{ $user->name }}</h2>
                                <p class="leading-relaxed text-gray-900">
                                    {{ $user->location }} &mdash;
                                </p>
                            </div>
                            <span class="md:flex-grow flex items-center justify-end">
                        <span>{{ $user->created_at->diffForHumans() }}</span>
                    </span>
                        <br>
                        <form action="{{route('user.setAdmin',$user->id)}}" method="post" enctype="multipart/form-data"> <?php // passar o id por argumento para update base dados
                            ?>
                            @method('PUT')
                            @csrf
                            <button type="submit">Set as Admin</button>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
