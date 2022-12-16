<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_hp');
            $table->string('no_hp_ortu');
            $table->string('role');
            $table->string('api-token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([

            'nama_lengkap' => 'anam',
            'email' =>'anam@gmail.com',
            'password'=> bcrypt(123),
            'no_hp'=>'082',
            'no_hp_ortu'=>'082',
            'role'=>'user',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
