<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#2e4057">
    <a class="navbar-brand" href="{{ url('/')}}">Find Job</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse"  id="navbarSupportedContent">
        @if(Auth::check())
        <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                </svg>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @if(Auth::user()->isAdmin())
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('/admin/home') }}">Dashboard</a>
                    @elseif(Auth::user()->isCompany())
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/company/home') }}">Dashboard</a>
                @endif
                    <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('/account/settings') }}">Settings</a>
                @if(Auth::user()->isAdmin())
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('/formAdmin') }}">Management</a>
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
        <a type="button" class="btn btn-outline-light" style="float:right;" href="{{url('login')}}">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
            </svg>
        </a>
        @endif
    </div>
</nav>
