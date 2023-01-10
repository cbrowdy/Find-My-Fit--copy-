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
        Schema::create('outfits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->references('id')->on('users')->nullable();
            $table->binary('innerwear');
            $table->binary('outterwear');
            $table->binary('bottom');
            $table->binary('shoes');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE outfits MODIFY COLUMN innerwear longblob");
        DB::statement("ALTER TABLE outfits MODIFY COLUMN outterwear longblob");
        DB::statement("ALTER TABLE outfits MODIFY COLUMN bottom longblob");
        DB::statement("ALTER TABLE outfits MODIFY COLUMN shoes longblob");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outfits');
    }
};
