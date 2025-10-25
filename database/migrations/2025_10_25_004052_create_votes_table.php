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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            // *constrained() -> Add foreign key rule.
            // It means the chirp_id and user_id must match real records that already exist.
            // *cascadeOnDelete() -> When related data is deleted, the matching records in this table are also deleted automatically.
            // (e,g,) If a user is deleted, their votes are also deleted. / If a chirp (post) is deleted, all votes for that chirp are deleted too.
            $table->foreignId('chirp_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->smallInteger('vote');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
