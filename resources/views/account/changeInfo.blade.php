@extends('layouts.template')
@section('title')
    Information | Find Job
@endsection
@section ('content')
    <div class="container">
            <form class="form-horizontal" method="post">
                @csrf
                <h2>Information</h2>
                <!-- Email -->
                <div class="form-group">
                    <label class="control-label">Email</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="email contact" name="email" value = "{{ old('email') ? :  $info[0] }}">
                </div>
                <!-- About Me-->
                <div class="form-group">
                    <label class="control-label">About Me</label>
                    <textarea id="content" name="aboutMe" placeholder="About Me" rows="3" cols="128" ></textarea>
                </div>
                <!-- Location -->
                <div class="control-group">
                    <label class="control-label">Location</label>
                        <input type="text" class="form-control" id="inputAddress" name="location" placeholder="Location" value = "{{ old('location') ? :  $info[2] }}" >
                        <p class="help-block"></p>
                </div>
                <button type="submit" class="btn btn-dark" style="background-color:#2e4057">Submit</button>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
    </div>
@endsection
