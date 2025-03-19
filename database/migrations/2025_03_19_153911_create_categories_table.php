<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        DB::table('categories')->insert([
            ['name' => 'fudbal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'opste znanje', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'istorija', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'nauka', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'geografija', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
