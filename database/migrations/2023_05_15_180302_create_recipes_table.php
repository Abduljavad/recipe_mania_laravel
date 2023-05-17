<?php

use App\Models\Category;
use App\Models\Cuisine;
use App\Models\DifficultyLevel;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name');
            $table->string('status')->nullable();
            $table->text('instructions')->nullable();
            $table->string('img')->nullable();
            $table->foreignIdFor(Category::class)->nullable();
            $table->foreignIdFor(Cuisine::class)->nullable();
            $table->foreignIdFor(DifficultyLevel::class)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
