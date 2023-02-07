<?php

use App\Commons\Constants;
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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->integer('id')->nullable(false)->primary();
            $table->string('first_name', 50)->nullable(true);
            $table->string('last_name', 50)->nullable(true);
            $table->string('avatar', 255)->default(Constants::DEFAULT_AVATAR());
            $table->smallInteger('gender')->nullable(true);
            $table->date('birthday')->nullable(true);
            $table->string('phone', 15)->nullable(true);
            $table->string('address_detail', 100)->nullable(true);
            $table->string('address_commune_id', 10)->nullable(true);
            $table->string('facebook', 50)->nullable(true);
            $table->string('youtube', 50)->nullable(true);
            $table->string('instagram', 50)->nullable(true);
            // timestamps
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
        Schema::dropIfExists('user_infos');
    }
};
