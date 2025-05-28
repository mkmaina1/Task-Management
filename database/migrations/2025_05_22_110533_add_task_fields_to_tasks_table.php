<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->string('title')->after('id');
        $table->text('description')->nullable()->after('title');
        $table->boolean('is_completed')->default(false)->after('description');
        $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('is_completed');
        $table->date('due_date')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn(['title', 'description', 'is_completed', 'user_id']);
    });
}

};
