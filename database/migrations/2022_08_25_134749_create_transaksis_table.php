<?php

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi');
            $table->string('biaya');
            $table->foreignId('user_id')->constrained('users');
            $table->string('keperluan');
            $table->string('bukti_transaksi');
            $table->timestamps();
        });
        // Transaksi::create([

        //     'transaksi' => 'Shopee',
        //     'biaya' =>'3000000',
        //     'user_id'=> '1',
        //     'keperluan'=> 'baju MU'
          
        // ]);

        // Transaksi::create([

        //     'transaksi' => 'DANA',
        //     'biaya' =>'120000',
        //     'user_id'=> '1',
        //     'keperluan'=> 'ngopi'
          
        // ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
