<?php

use App\Models\GigResponse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGigResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gig_responses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('status')->default(GigResponse::STATUS_PENDING);
            $table->dateTime('response_time')->nullable();
            $table->string('comment')->nullable();
            
            $table->foreignID('user_id');
            $table->foreignID('gig_id');

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
        Schema::dropIfExists('gig_responses');
    }
}
