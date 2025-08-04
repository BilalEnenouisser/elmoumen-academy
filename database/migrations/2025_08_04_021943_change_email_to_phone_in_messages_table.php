<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('phone')->after('name');
        });
        
        // Copy data from email to phone
        DB::statement('UPDATE messages SET phone = email');
        
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('email')->after('name');
        });
        
        // Copy data from phone to email
        DB::statement('UPDATE messages SET email = phone');
        
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
};
