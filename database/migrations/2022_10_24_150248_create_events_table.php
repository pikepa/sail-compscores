<?php

use App\Models\Competition;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('seq_no')->nullable();
            $table->text('event_name');
            $table->text('event_description');
            $table->timestamp('event_date');
            $table->string('event_time')->nullable();
            $table->string('event_type');
            $table->string('event_status');
            $table->foreignIdFor(Competition::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('events');
    }
};
