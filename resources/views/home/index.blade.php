@extends('layouts.app')
@include('home.sidebar')
@include('home.recipes-index')
@section('content')
    <!-- head section-->
    <section class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Welcome to Recipe Mania!</h1>
            <p class="lead">Share your favorite recipes with the world.</p>
        </div>
    </section>
    <!-- Main Body section -->
    <div class="body-container">
        <!-- side bar -->
        <div class="sidebar-section">
            @yield('side-bar')
        </div>
        <div class="main-section">
            <!-- Recipe Section -->
            @yield('recipes-index')
        </div>
    </div>
@endsection

@section('nav-bar')
<ul class="nav nav-pills me-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Categories</a>
        <div class="dropdown-menu">
            @foreach ($categories as $category)
                <a class="dropdown-item" href="{{ route('recipe.category',$category->id) }}">{{ $category->name }}</a>
            @endforeach
        </div>
    </li>    

    <li class="nav-item">
        <a class="nav-link" href="{{ route('saved-items') }}">Favourites</a>
    </li> 
    
</ul>
<form class="form-inline my-2 my-lg-0" action="{{ route('home') }}" method="GET">
    <input class="form-control mr-sm-2" type="search" name="name" value="{{ request('name') }}" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form> 
@endsection