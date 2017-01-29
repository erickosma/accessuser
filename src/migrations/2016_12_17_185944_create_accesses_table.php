<?php

use Illuminate\Database\Schema\Blueprint;
use Zoy\Accessuser\Bases\MigrationAccess;

class CreateAccessesTable extends MigrationAccess
{

    protected $table = 'accesses';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createSchema(function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique();
            $table->string('client_ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        parent::down();
    }
}
