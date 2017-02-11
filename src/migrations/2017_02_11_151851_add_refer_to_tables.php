<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferToTables extends MigrationAccess
{

    protected $table = 'access_agents';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add access agent relationship
        $this->createSchema(function (Blueprint $table) {
            $table->foreign('access_id')
                ->references('id')->on('accesses')
                ->onDelete('cascade');
        });
        $this->table = "access_devices";
        //add access device  relationship
        $this->createSchema(function (Blueprint $table) {
            $table->foreign('access_id')
                ->references('id')->on('accesses')
                ->onDelete('cascade');
        });

        $this->table = "access_domains";
        //add access domains  relationship
        $this->createSchema(function (Blueprint $table) {
            $table->foreign('access_id')
                ->references('id')->on('accesses')
                ->onDelete('cascade');
        });

        $this->table = "access_routes";
        //add access routes  relationship
        $this->createSchema(function (Blueprint $table) {
            $table->foreign('access_id')
                ->references('id')->on('accesses')
                ->onDelete('cascade');
        });

        $this->table = "access_event_users";
        $this->createSchema(function (Blueprint $table) {
            $table->foreign('access_id')
                ->references('id')->on('accesses')
                ->onDelete('cascade');
        });

        $this->table = "access_user_logs";
        $this->createSchema(function (Blueprint $table) {
            $table->foreign('access_id')
                ->references('id')->on('accesses')
                ->onDelete('cascade');
        });

        /*
         *  $this->builder->table($this->foreign, function ($table) {
            $table->foreign('referer_id', 'tracker_referers_referer_id_fk')
                ->references('id')
                ->on('tracker_referers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
