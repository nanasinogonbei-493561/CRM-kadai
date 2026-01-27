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
        if (!Schema::hasColumn('deals', 'contact_id')) {
            Schema::table('deals', function (Blueprint $table) {
                $table->foreignId('contact_id')->nullable()->constrained()->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('deals', 'contact_id')) {
            Schema::table('deals', function (Blueprint $table) {
                $table->dropConstrainedForeignId('contact_id');
            });
        }
    }

};
