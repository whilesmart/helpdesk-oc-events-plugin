<?php namespace WhilesmartHelpdesk\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSponsorsTable extends Migration
{
    public function up()
    {
        Schema::create('whilesmarthelpdesk_sponsors', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();

        });

        Schema::create('whilesmarthelpdesk_event_sponsors', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('event_id')->unsigned();
            $table->integer('sponsor_id')->unsigned();
            $table->primary(['event_id', 'sponsor_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('whilesmarthelpdesk_sponsors');
        Schema::dropIfExists('whilesmarthelpdesk_event_sponsors');
    }
}
