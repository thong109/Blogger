<?php

use App\Commons\CodeMasters\CategoryStatus;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->string('slug', 255)->nullable(false);
            $table->smallInteger('status')->default(CategoryStatus::USING());
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
        Schema::dropIfExists('categories');
    }
};
