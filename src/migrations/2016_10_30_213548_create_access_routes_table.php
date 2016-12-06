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
            $table->bigInteger('access_user_id')->index();
            $table->string('name')->index();
            $table->string('action');
            $table->string('path');
            $table->timestamps();
        });
    }


}
