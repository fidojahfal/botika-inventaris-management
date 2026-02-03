<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->string("id")->primary();
            $table->string("name");
            $table->string("type");
            $table->string("serial_number")->unique();
            $table->string("spesifikasi");
            $table->foreignId("status_id")->constrained("status_inventaris");
            $table->foreignId("assigned_user_id")->nullable()->constrained("users")->nullOnDelete();
            $table->foreignId("department_id")->nullable()->constrained("departments")->nullOnDelete();
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
        Schema::dropIfExists('inventaris');
    }
}
