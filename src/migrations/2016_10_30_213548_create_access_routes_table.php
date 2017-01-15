<?php

use Illuminate\Database\Schema\Blueprint;
use Zoy\Accessuser\Bases\MigrationAccess;

class CreateAccessRoutesTable extends MigrationAccess
{

    protected $table = 'access_routes';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createSchema(function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('access_id')->index();
            $table->string('controller')->index();
            $table->string('action');
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->boolean('is_ajax');
            $table->string('time')->default(0);
            $table->timestamps();
        });
    }


}
