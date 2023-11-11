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
    const CATEGORIES = [
        ['name' => 'Sport'],
        ['name' => 'Politics'],
        ['name' => 'Lifestyle'],
        ['name' => 'News'],
        ['name' => 'Weather'],
        ['name' => 'Economy'],
        ['name' => 'Health'],
        ['name' => 'Travel'],
        ['name' => 'Opinion'],
    ];

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        \Illuminate\Support\Facades\DB::table('categories')->insert(self::CATEGORIES);
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
