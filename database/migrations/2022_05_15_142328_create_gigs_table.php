<?php

use App\Models\Gig;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gigs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('location');
            $table->dateTime('gig_start');
            $table->dateTime('gig_end')->nullable();
            $table->integer('fee')->nullable();
            $table->integer('status')->default(Gig::STATUS_OPEN);

            $table->foreignID('team_id');
            $table->foreignId('created_by');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gigs');
    }
}
