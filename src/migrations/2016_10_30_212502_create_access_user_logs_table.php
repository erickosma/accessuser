<?php


use Illuminate\Database\Schema\Blueprint;
use Zoy\Accessuser\Bases\MigrationAccess;

class CreateAccessUserLogsTable extends MigrationAccess
{


    /* ------------------------------------------------------------------------------------------------
    |  Properties
    | ------------------------------------------------------------------------------------------------
    */
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'access_user_logs';

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
            $table->integer('user_id')->index();
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
