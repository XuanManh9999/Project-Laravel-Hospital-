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
        // Đổi kiểu dữ liệu sang LONGTEXT bằng SQL raw để tránh phụ thuộc vào gói doctrine/dbal
        DB::statement('ALTER TABLE doctors MODIFY avatar LONGTEXT NULL;');
        DB::statement('ALTER TABLE posts MODIFY image LONGTEXT NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE doctors MODIFY avatar VARCHAR(255) NULL;');
        DB::statement('ALTER TABLE posts MODIFY image VARCHAR(255) NULL;');
    }
};
