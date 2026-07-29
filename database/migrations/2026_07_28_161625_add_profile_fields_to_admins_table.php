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
        Schema::table('admins', function (Blueprint $table) {
            if (!Schema::hasColumn('admins', 'name')) {
                $table->string('name', 150)->nullable()->after('username');
            }
            if (!Schema::hasColumn('admins', 'email')) {
                $table->string('email', 180)->nullable()->unique()->after('name');
            }
            if (!Schema::hasColumn('admins', 'avatar')) {
                $table->string('avatar', 255)->nullable()->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropColumn(['name', 'email', 'avatar']);
        });
    }
};
