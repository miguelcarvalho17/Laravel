@extends('layouts.template')
@section ('title')
    Find Job
@endsection
@section ('content')
    <form action="{{url('/applyJob')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{Auth::user()->name}}" name="userId">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Job:</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$job->title}}" name="jobId">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Tell us why you deserve this job</label>
            <textarea class="form-control" name="offer_content" id="exampleFormControlTextarea1" rows="3"></textarea>
            <div class="form-group">
                <label for="exampleFormControlFile1">Insert here your CV</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="cv">
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2">Apply</button>
        </div>
    </form>
    @if(Session::has('sucessInsert'))
        <p class="alert alert-success">{{ Session::get('sucessInsert') }}</p>
    @endif
@endsection
