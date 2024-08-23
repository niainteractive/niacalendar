<?php namespace NiaInteractive\Event\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateNiainteractiveEventEvents extends Migration
{
    public function up()
    {
        Schema::create('niainteractive_event_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('title')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->boolean('all_day')->nullable();
            $table->boolean('has_end_date')->nullable();
            $table->longText('description')->nullable();
            $table->string('color')->nullable();
            $table->boolean('is_active')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('niainteractive_event_events');
    }
}
