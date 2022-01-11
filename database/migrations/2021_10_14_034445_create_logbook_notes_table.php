<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_status')->default(0);
            $table->unsignedBigInteger('id_user')->default(0);
            $table->unsignedBigInteger('dosen_kp')->default(0);
            $table->unsignedBigInteger('dosen_lap')->default(0);
            $table->unsignedBigInteger('dosen_pembimbing')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logbook_notes');
    }
}
