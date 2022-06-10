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
        Schema::create('ballots', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('event_id')->references('id')->on('events');
            $table->foreignUuid('voter_id')->references('id')->on('voters');
            $table->foreignUuid('option_id')->references('id')->on('options');
            $table->timestamp('voted_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ballots');
    }
};
