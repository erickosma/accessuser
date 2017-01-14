<?php

use Illuminate\Database\Schema\Blueprint;
use Zoy\Accessuser\Bases\MigrationAccess;

class CreateAccessAgentsTable extends MigrationAccess
{

    protected $table = 'access_agents';

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
            $table->string('name');
            $table->string('browser')->index();
            $table->string('browser_version');
            $table->timestamps();
        });
    }


}
