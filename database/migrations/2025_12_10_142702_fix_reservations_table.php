<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            if (!Schema::hasColumn('reservations', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }
            if (!Schema::hasColumn('reservations', 'book_id')) {
                $table->unsignedBigInteger('book_id')->after('user_id');
            }
            if (!Schema::hasColumn('reservations', 'reserved_at')) {
                $table->timestamp('reserved_at')->nullable()->after('book_id');
            }
            if (!Schema::hasColumn('reservations', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('reserved_at');
            }
            if (!Schema::hasColumn('reservations', 'released_at')) {
                $table->timestamp('released_at')->nullable()->after('approved_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'book_id', 'reserved_at', 'approved_at', 'released_at']);
        });
    }
};
