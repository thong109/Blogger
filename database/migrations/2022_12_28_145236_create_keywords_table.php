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
        Schema::create('keywords', function (Blueprint $table) {
            $table->id();
            $table->string('keyword',255)->nullable(false);
            $table->timestamp('created_at')->useCurrent();
            $table->integer('created_by')->nullable(false);
            $table->timestamp('updated_at')->nullable(true);
            $table->integer('updated_by')->nullable(true);
            $table->timestamp('deleted_at')->nullable(true);
            $table->integer('deleted_by')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keywords');
    }
};
