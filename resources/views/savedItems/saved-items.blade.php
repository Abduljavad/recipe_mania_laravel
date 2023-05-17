@extends('layouts.app')
@include('home.back-button')
@section('content')
    <div class="container">
        @if ($savedItems->count() == 0)
        <div class="row">
            <div class="col-md-15 d-flex align-items-center justify-content-center">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/sorry-item-not-found-3328225-2809510.png" alt="">
            </div>
          </div>
        @endif
        <div class="row g-3">
            @foreach ($savedItems as $savedItem)
                <div class="col-md-3">
                    <div class="card bg-light h-100">
                        <a href="{{ route('recipe.show', $savedItem->recipe->id) }}">
                            <img src="{{ $savedItem->recipe->img }}" class="card-img-top" alt="Recipe Image"
                                style="object-fit: cover; height: 200px;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title" style="overflow: hidden;">{{ $savedItem->recipe->name }}</h5>
                            <p class="card-text">Difficulty: {{ $savedItem->recipe->difficultyLevel->name }}</p>
                            <a href="{{ route('recipe.show', $savedItem->recipe->id) }}" class="btn btn-primary">Read
                                More</a>
                            <form action="{{ route('unsave-recipe', $savedItem->recipe->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Un-Save</button>
                            </form>

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
