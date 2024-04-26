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
        Schema::table('users', function (Blueprint $table) {
            $table->after('name', function (Blueprint $table) {
                $table->foreignId('document_type_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            });

            $table->after('remember_token', function (Blueprint $table) {
                $table->bigInteger('phone')->unsigned();
                $table->string('address');
                $table->bigInteger('document')->unique()->unsigned();
                $table->boolean('is_active')->default(true);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('document_type_id');
            $table->dropColumn('status');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('document')->unique()->unsigned();
            $table->dropColumn('is_active')->default(true);
        });
    }
};
