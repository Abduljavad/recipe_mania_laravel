@section('side-bar')
<div class="col-md-3">
    <form method="GET" action="{{ route('home') }}">
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"{{ $category->id == request('category_id') ? ' selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cuisine_id">Cuisine</label>
            <select class="form-control" id="cuisine_id" name="cuisine_id">
                <option value="">All Cuisines</option>
                @foreach($cuisines as $cuisine)
                    <option value="{{ $cuisine->id }}"{{ $cuisine->id == request('cuisine_id') ? ' selected' : '' }}>
                        {{ $cuisine->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="difficulty_level_id">Difficulty</label>
            <select class="form-control" id="difficulty_level_id" name="difficulty_level_id">
                <option value="">All Difficulty Levels</option>
                @foreach($difficultyLevels as $difficultyLevel)
                    <option value="{{ $difficultyLevel->id }}"{{ $difficultyLevel->id == request('difficulty_level_id') ? ' selected' : '' }}>
                        {{ $difficultyLevel->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
</div>
@endsection
