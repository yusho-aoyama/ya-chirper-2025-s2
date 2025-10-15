<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chirps', function (Blueprint $table) {
            $table->id();   // id - big int, unsigned, autoincrement
//            $table->foreignId('user_id')
//                ->constrained()
//                ->cascadeOnDelete();
//            $table->string('message');
            $table->foreignIdFor(\App\Models\User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('message', 255)
                -> nullable();      // IF I WANT TO ALLOW THE MESSAGE TO BE EMPTY,

            $table->timestamps();   // created_at updated_at datetime
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chirps');
    }
};
