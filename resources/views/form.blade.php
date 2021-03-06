<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Insert Jobs | Find Job</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Post Job</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('form')}}">Insert <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('formEditRemoveCompany')}}">Edit/Remove</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}">Mainpage</a>
                    </li>
                </ul>
            </div>
        </nav>
        <form action="{{url('/form')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="inputName" name="title" value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Type of job</label>
                <select class="form-control" id="exampleFormControlSelect1" name="typeJob" value="{{old('typeJob')}}">
                    <option value="" selected disabled hidden>Choose here</option>
                    <option value="pt">Part Time</option>
                    <option value="ft">Full Time</option>
                    <option value="vt">Volunteer</option>
                    <option value="it">Internship</option>
                </select>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="company">Salary</label>
                        <input type="text" class="form-control" id="inputFirstSpect"  value="{{old('salary')}}"name="salary">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="location">Location</label>
                        <input type="TEXT" class="form-control" id="inputSecSpect"  value="{{old('location')}}"name="location">
                    </div>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="job_content" rows="5" cols="128">{!! old('job_content') !!}
            </textarea>
                </div>

                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" class="form-control" id="exampleInputFile">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @if(Session::has('sucessInsert'))
            <p class="alert alert-success">{{ Session::get('sucessInsert') }}</p>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <br>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
