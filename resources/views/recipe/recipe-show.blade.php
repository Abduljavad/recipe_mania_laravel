@extends('layouts.app')
@include('recipe.recipe-ratings')
@include('home.back-button')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $recipe->name }}</h3>
                    </div>
                    <div class="card-body">
                        <img src="{{ $recipe->img }}" alt="{{ $recipe->name }}" class="card-img-top"
                            style="object-fit: cover; height: 300px; border-radius:10px;">
                        <div class="card-desc" style="padding: 10px">
                            <h5 class="mt-2">Recipe By: <a href="">{{ $recipe->user->name }}</a></h5>
                            @if (auth()->check() && auth()->user()->id !== $recipe->user_id)
                                @if (auth()->user()->isFollowing($recipe->user))
                                    <form action="{{ route('unfollow', $recipe->user_id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary d-inline-block mb-2" type="submit">Unfollow</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', $recipe->user_id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary d-inline-block mb-2" type="submit">Follow</button>
                                    </form>
                                @endif
                            @endif
                            @if (auth()->check())
                                @if (auth()->user()->isSavedItem($recipe))
                                    <form action="{{ route('unsave-recipe', $recipe->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Unsave Recipe</button>
                                    </form>
                                @else
                                    <form action="{{ route('save-recipe', $recipe->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Save Recipe</button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">Save Recipe</a>
                            @endif
                            @if ($avgRating)
                                <h4>Rating</h4>
                                <ul>
                                    <li>{{ $avgRating }} Star | {{ $recipe->ratings->count() }} Reviews</li>
                                </ul>
                            @endif
                            <h4>Ingredients</h4>
                            <ul>
                                @foreach ($recipe->ingredients as $ingredient)
                                    <li>{{ $ingredient->name }} - {{ $ingredient->quantity }}</li>
                                @endforeach
                            </ul>
                            <h4>Instructions</h4>
                            <ul>
                                <li>
                                    <p>{{ $recipe->instructions }}</p>
                                </li>
                            </ul>
                            <h4>Category</h4>
                            <ul>
                                <li>
                                    <p>{{ $recipe->category->name }}</p>
                                </li>
                            </ul>
                            <h4>Cuisine</h4>
                            <ul>
                                <li>
                                    <p>{{ $recipe->cuisine->name }}</p>
                                </li>
                            </ul>
                            <h4>Difficulty</h4>
                            <ul>
                                <li>
                                    <p>{{ $recipe->difficultyLevel->name }}</p>
                                </li>
                            </ul>
                            <!-- Add Review Form -->
                            @if (!Auth::check())
                                <p>Please <a href="{{ route('login') }}">login</a> to add a review.</p>
                            @elseif ($recipe->ratings()->where('user_id', auth()->user()->id)->first())
                                <p></p>
                            @else
                                <form method="POST" action="{{ route('ratings.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="rating">Rating:</label>
                                        <input type="text" hidden value="{{ $recipe->id }}" name="recipe_id">
                                        <select name="rating" id="rating" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4
                                            </option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="review">Review:</label>
                                        <textarea name="review" id="review" rows="3" cols="50" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Review</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('recipe-ratings')
@endsection
@section('nav-bar')
    <ul class="nav nav-pills me-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Categories</a>
            <div class="dropdown-menu">
                @foreach ($categories as $category)
                    <a class="dropdown-item" href="{{ '' }}">{{ $category->name }}</a>
                @endforeach
            </div>
        </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="#" method="GET">
        <input class="form-control mr-sm-2" type="search" name="name" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
@endsection
@section('back-button')
@yield('back-button')
@endsection
