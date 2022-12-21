<?php

use App\Models\Competition;
use App\Models\Competitor;
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
        Schema::create('competition_competitors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Competitor::class);
            $table->foreignIdFor(Competition::class);
            $table->string('entry_status')->default('unpaid');
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
        Schema::dropIfExists('competition_competitors');
    }
};
