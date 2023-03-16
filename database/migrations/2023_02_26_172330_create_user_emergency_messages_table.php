<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_emergency_messages', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained( 'users' )->cascadeOnDelete();
            $table->foreignId('emergency_message_id')->constrained( 'emergency_messages' )->cascadeOnDelete();
            $table->primary(['user_id', 'emergency_message_id']);
            $table->timestamps();
        });
    }
    public $timestamps = false;
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_emergency_messages');
    }
};
