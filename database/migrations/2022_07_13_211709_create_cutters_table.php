<?php

use App\Models\Cutter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuttersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cutters', function (Blueprint $table) {
            $table->id();

            $table->text('link');
            $table->string('hash', Cutter::LIMIT_SYMBOLS);
            $table->datetime('life_time');
            $table->integer('limit')->nullable();

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
        Schema::dropIfExists('cutters');
    }
}
