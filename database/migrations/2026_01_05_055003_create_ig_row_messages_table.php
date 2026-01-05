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
        Schema::create('ig_row_messages', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); // Instagram Sender ID
            $table->string('user_name')->nullable(); // Fetched via API
            $table->text('message');
            $table->timestamp('timestamp')->nullable(); // Message timestamp
            $table->timestamps(); // Created At / Updated At
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ig_row_messages');
    }
};
