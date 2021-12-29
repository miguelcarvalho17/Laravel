<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#2e4057">
    <a class="navbar-brand" href="{{ url('/')}}">Find Job</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg> Type of Job
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('catalogue/itJobs') }}">IT Jobs</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('catalogue/sports')}}">Sports Job</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('catalogue/healthcare')}}">Healthcare Jobs</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get" action="{{url('catalogue/displaySearch')}}">
            @csrf
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="position:relative;right:5%;height:1%" name="search" id="search">
            <button type="submit" class="btn btn-outline-light" style="position:relative;right:5%;">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                </svg>
            </button>
        </form>
        @if(Auth::check())
        <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                </svg>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ url('/account/settings') }}">Settings</a>
                @if(Auth::user()->isAdmin())
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('/form') }}">BackOffice</a>
                <div class="dropdown-divider"></div>
                    @elseif(Auth::user()->isCompany())
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/form') }}">Post Job</a>
                        <div class="dropdown-divider"></div>
                @else
                <div class="dropdown-divider"></div>
                @endif
                <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
            </div>
        </div>
        @else
            <a type="button" class="btn btn-outline-light" href="{{url('login')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank2" viewBox="0 0 16 16">
                    <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916l-7.5-5zM12.375 6v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2zM.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1H.5z"/>
                </svg>
            </a>

        <a type="button" class="btn btn-outline-light" href="{{url('login')}}">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
            </svg>
        </a>
        @endif
    </div>
</nav>
