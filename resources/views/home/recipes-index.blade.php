@section('recipes-index')
@if ($recipes->count() == 0)
<div class="row">
  <div class="col-md-15 d-flex align-items-center justify-content-center">
      <img src="https://cdni.iconscout.com/illustration/premium/thumb/sorry-item-not-found-3328225-2809510.png" alt="">
  </div>
</div>

@endif
<div class="row g-3">
    @foreach ($recipes as $recipe)
    <div class="col-md-3">
      <div class="card bg-light h-100">
        <a href="{{ route('recipe.show',$recipe->id) }}">
          <img src="{{$recipe->img}}" class="card-img-top" alt="Recipe Image" style="object-fit: cover; height: 200px;">
        </a>
        <div class="card-body">
          <h5 class="card-title" style="overflow: hidden;">{{$recipe->name}}</h5>
          <p class="card-text">Difficulty: {{$recipe->difficultyLevel->name}}</p>
          <p class="card-text">Rating: {{$recipe->avgRating($recipe)? : 'Nil'}}</p>
          <a href="{{ route('recipe.show',$recipe->id) }}" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>  
@endsection
