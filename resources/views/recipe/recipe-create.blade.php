@extends('layouts.app')

@section('content')
    <div class="card col-md-5 offset-md-4">
        <div class="card-body">
            <h1 class="card-title">Add Recipe</h1>
            <form method="POST" id="myForm" action="{{ route('recipe.store') }}" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="instructions" class="form-label">Instructions:</label>
                    <textarea id="instructions" name="instructions" class="form-control" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" id="image" name="img" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select id="category" name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                    <option value="{{ $category->id }}"{{ $category->id == request('category_id') ? ' selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cuisine" class="form-label">Cuisine:</label>
                    <select id="cuisine" name="cuisine_id" class="form-select" required>
                        @foreach($cuisines as $cuisine)
                        <option value="{{ $cuisine->id }}"{{ $cuisine->id == request('cuisine_id') ? ' selected' : '' }}>
                            {{ $cuisine->name }}
                        </option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="difficulty" class="form-label">Difficulty Level:</label>
                    <select id="difficulty" name="difficulty_level_id" class="form-select" required>
                        @foreach($difficultyLevels as $difficultyLevel)
                        <option value="{{ $difficultyLevel->id }}"{{ $difficultyLevel->id == request('difficulty_level_id') ? ' selected' : '' }}>
                            {{ $difficultyLevel->name }}
                        </option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <h2>Ingredients</h2>
                    <div class="ingredients mb-1">
                        <div class="ingredient">
                            <input type="text" name="ingredient_name[]" placeholder="Ingredient Name"
                                class="form-control mb-1 mt-1" required>
                            <input type="text" name="ingredient_quantity[]" placeholder="Ingredient Quantity"
                                class="form-control" required>
                        </div>
                    </div>
                    <button type="button" id="add-ingredient" class="btn btn-secondary">Add Ingredient</button>
                </div>

                <button type="submit" class="btn btn-primary offset-md-10">Add Recipe</button>
            </form>
        </div>
    </div>
    <script>
        // JavaScript code to handle adding more ingredients dynamically
        document.getElementById('add-ingredient').addEventListener('click', function() {
            var ingredientContainer = document.querySelector('.ingredients');
            var ingredientTemplate = document.querySelector('.ingredient');
            var newIngredient = ingredientTemplate.cloneNode(true);
            ingredientContainer.appendChild(newIngredient);
        });
    </script>
@endsection
