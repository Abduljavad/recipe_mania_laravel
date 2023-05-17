@extends('layouts.app')
@include('home.back-button')
@section('content')
    <div class="container">
        @if ($recipes->count() == 0)
            <div class="row">
                <div class="col-md-15 d-flex align-items-center justify-content-center">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/sorry-item-not-found-3328225-2809510.png"
                        alt="">
                </div>
            </div>
        @endif
        <div class="row g-3">
            @foreach ($recipes as $recipe)
                <div class="col-md-3">
                    <div class="card bg-light h-100">
                        <a href="{{ route('recipe.show', $recipe->id) }}">
                            <img src="{{ $recipe->img }}" class="card-img-top" alt="Recipe Image"
                                style="object-fit: cover; height: 200px;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title" style="overflow: hidden;">{{ $recipe->name }}</h5>
                            <p>Difficulty: {{ $recipe->difficultyLevel->name }}</p>
                            <p>Status: {{ $recipe->status }}</p>
                            <a href="{{ route('recipe.show', $recipe->id) }}" class="btn btn-primary">Read
                                More</a>
                            @if ($recipe->status == 'drafted')
                                <form action="{{ route('recipe.publish', $recipe->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Publish</button>
                                </form>
                            @else
                                <button type="submit" disabled class="btn btn-primary">Published</button>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('back-button')
    @yield('back-button')
@endsection
