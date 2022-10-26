<?php

use App\Constants\Tables;
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
        Schema::create(Tables::TRANSACTIONS, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('wallet_id')->index();
            $table->bigInteger('amount');
            $table->string('reference_id', 11);

            $table->foreign('wallet_id')->references('id')->on(Tables::WALLETS)->onDelete('cascade');

            $table->timestamps();

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
        Schema::dropIfExists(Tables::TRANSACTIONS);
    }
};
