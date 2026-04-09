<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->boolean('phone_ng')->default(false)->after('status');
            $table->text('last_sales_status')->nullable()->after('phone_ng');
            $table->text('email_notes')->nullable()->after('last_sales_status');
            $table->text('call_notes')->nullable()->after('email_notes');
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['phone_ng', 'last_sales_status', 'email_notes', 'call_notes']);
        });
    }
};
