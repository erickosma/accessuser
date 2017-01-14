<?php

use Illuminate\Database\Schema\Blueprint;
use Zoy\Accessuser\Bases\MigrationAccess;

class CreateAccessDevicesTable extends MigrationAccess
{

    protected $table = 'access_devices';
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
            $table->string('kind', 16)->index();
            $table->string('model', 64)->index();
            $table->string('platform', 64)->index();
            $table->string('platform_version', 16);
            $table->boolean('is_mobile');
            $table->boolean('is_robot');
            $table->unique(['access_id','kind', 'model', 'platform', 'platform_version']);
            $table->timestamps();
        });
    }

}
