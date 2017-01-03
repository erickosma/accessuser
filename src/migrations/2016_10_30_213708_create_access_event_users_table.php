<?php

use Illuminate\Database\Schema\Blueprint;
use Zoy\Accessuser\Bases\MigrationAccess;

class CreateAccessEventUsersTable extends MigrationAccess
{

    protected $table = 'access_event_users';

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
            $table->bigInteger('evento_id')->index();
            $table->timestamps();
        });
    }


}
