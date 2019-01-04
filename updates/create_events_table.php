<?php namespace WhilesmartHelpdesk\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('whilesmarthelpdesk_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->date('start_date');
            $table->date('close_date');
            $table->time('start_time');
            $table->time('close_time');
            $table->text('description');
            $table->string('poster');
            $table->string('location', 250);
            $table->text('location_embed');
            $table->string('registration_link', 250);
            $table->string('slug');
            $table->integer('user_id')->unsigned();
            $table->boolean('public');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('whilesmarthelpdesk_events');
    }
}
