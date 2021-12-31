<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Manage Jobs | Find Job</title>
</head>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">BackOffice</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li>
                    <a class="nav-link active" href="{{route('formEditRemove')}}">Edit/Remove <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">Mainpage</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-12">
            <table class="table table-image" style="background-color:white">
                <thead>
                <tr style="font-weight:bold">
                    <th scope="col">Picture</th>
                    <th scope="col">Title</th>
                    <th scope="col">Location</th>
                    <th scope="col">Salary</th>
                    <td scope="col">Content</td>
                    <td scope="col">Reenter Picture</td>
                    <th scope="col">Edit</th>
                    <th scope="col">Remove</th>
                </tr>
                </thead>
        </div>
        <tbody>
        @forelse($jobs as $job)
            <form action="{{route('job.edit',$job->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <tr>
                    <td class="w-25">
                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($job->logo)) }}" class="img-fluid img-thumbnail" alt="{{$job->name}}" width="300" height="300">
                    </td>

                    <td style="font-size:20px"><input type="text" name="title" id="title" class="form-control" value="{{ old('title') ? : $job->title }}"></td>
                    <td style="font-size:20px"><input type="text" name="salary" id="title" class="form-control" value="{{ old('salary') ? : $job->salary }}"></td>
                    <td style="font-size:20px"><input type="text" name="location" id="title" class="form-control" value="{{ old('location') ? : $job->location }}"></td>
                    <td style="font-size:20px"><input type="text" name="content" id="title" class="form-control" value="{{ old('content') ? : $job->content }}"></td>
                        
                    <td><input type="file" name="picture" class="form-control" id="exampleInputFile"></td>
                    <td><button type="submit" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16" name="edit">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg></button></td>
            </form>
            <form action="{{route('job.remove',$job->id)}}" method="post"> <?php // passar o id por argumento para remover e em cima para editar
                ?>
                @method('DELETE')
                @csrf
                <td><button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" name="remove">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg></button></td>
            </form>
            </tr>
        @empty
            <h5 class="text-center">No Jobs Like this where Found!</h5>
        @endforelse
        </tbody>
        </table>
      
        @if(Session::has('sucessEdit'))
            <p class="alert alert-success">{{ Session::get('sucessEdit') }}</p>
        @endif
        @if(Session::has('sucessRemove'))
            <p class="alert alert-success">{{ Session::get('sucessRemove') }}</p>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                @endforeach
                @endif
            </div>
            </form>
    </div>
    </body>
