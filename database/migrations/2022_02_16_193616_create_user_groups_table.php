<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ 
    public function up()
    {
        Schema::create('user_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("group_id");
            $table->foreign("user_id")->references("id")->on("users")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreign("group_id")->references("id")->on("groups")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_groups');
    }
};
