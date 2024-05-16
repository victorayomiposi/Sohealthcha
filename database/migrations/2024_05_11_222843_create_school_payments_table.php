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
        Schema::create('school_payments', function (Blueprint $table) {
            $table->id();
            $table->string('purpose');
            $table->string('email');
            $table->decimal('amount', 10, 2);
            $table->string('phone');
            $table->timestamp('time')->useCurrent();
            $table->tinyInteger('status')->default(0);
            $table->string('fullname');
            $table->string('department');
            $table->string('admissionnumber');
            $table->string('session');
            $table->string('authorizationUrl');
            $table->string('reference');
            $table->string('credoReference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_payments');
    }
};
