@section('recipe-ratings')
    @if ($recipe->ratings()->first())
        <div class="container">
            <h1 class="offset-md-5 mt-2">Reviews</h1>
            @foreach ($recipe->ratings as $rating)
                <div class="card col-md-6 offset-md-3 mt-2">
                    <div class="card-body">
                        <h4 class="card-title">{{ $rating->user->name }}</h4>
                        <p class="card-text">Review : {{ $rating->review }}</p>
                        <p class="card-text">Rating : {{ $rating->rating }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
