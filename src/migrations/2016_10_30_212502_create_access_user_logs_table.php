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
    protected $table = 'user_logs';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createSchema(function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->index();
            $table->uuid('uuid')->unique();
            $table->string('client_ip');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->unique(['user_id', 'client_ip']);
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
