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
                <img src="https://tm.ibxk.com.br/2019/10/18/18180753819133.jpg?ims=1200x675" class="d-block w-100" alt="Oracle Company">
            </div>
            <div class="carousel-item">
                <img src="https://www.pcguia.pt/wp-content/uploads/2021/11/Microsoft.jpg" class="d-block w-100" alt="Microsoft Brand">
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
<table class="table table-borderless">
    <thead>
        <tr style="background-color:#2e4057;">
            <th scope="col" style="color:white;">JOBS</th>
        </tr>
    </thead>
</table>
</form>
@endsection