<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            if (!Schema::hasColumn('borrowings', 'due_date')) {
                $table->date('due_date')->nullable();
            }

            if (!Schema::hasColumn('borrowings', 'penalty')) {
                $table->integer('penalty')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn(['due_date', 'penalty']);
        });
    }
};
