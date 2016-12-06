<?php

use Illuminate\Database\Schema\Blueprint;
use Zoy\Accessuser\Bases\MigrationAccess;

class CreateAccessAgentsTable extends MigrationAccess
{
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
            $table->string('name')->unique();
            $table->string('browser')->index();
            $table->string('browser_version');
            $table->timestamps();
        });
    }


}
