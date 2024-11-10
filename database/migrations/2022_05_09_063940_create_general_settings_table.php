<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_logo')->nullable();
            $table->string('site_name');
            $table->string('site_title');
            $table->string('footer_desc');
            $table->string('theme_color');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('tax');
            $table->string('cur_format');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });

        DB::table('general_settings')->insert([
            'site_logo'=> 'bus.png',
            'site_name'=>'Bus Reservation',
            'site_title'=>'Bus Reservation',
            'footer_desc'=>'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',
            'theme_color'=>'#007bff',
            'phone'=>'9632587410',
            'email'=>'company@gmail.com',
            'address'=>'New York,USA',
            'tax'=>'18',
            'cur_format'=>'$',
            'latitude'=>'40.730610',
            'longitude'=>'-73.935242'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
