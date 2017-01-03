<?php

use Illuminate\Database\Schema\Blueprint;
use Zoy\Accessuser\Bases\MigrationAccess;

class CreateAccessDomainsTable extends MigrationAccess
{

    protected $table = 'access_domains';
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
            $table->string('url')->index();
            $table->string('host');
            $table->string('search_terms_hash')->nullable();
            $table->timestamps();
        });
    }


}
