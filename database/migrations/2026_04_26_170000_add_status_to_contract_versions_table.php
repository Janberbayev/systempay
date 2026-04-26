<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('contract_versions')) {
            return;
        }

        Schema::table('contract_versions', function (Blueprint $table) {
            if (! Schema::hasColumn('contract_versions', 'status')) {
                $table->enum('status', ['draft', 'signed', 'archived'])
                    ->default('draft');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('contract_versions')) {
            return;
        }

        Schema::table('contract_versions', function (Blueprint $table) {
            if (Schema::hasColumn('contract_versions', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
