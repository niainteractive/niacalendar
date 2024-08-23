<?php namespace NiaInteractive\Event\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateNiainteractiveEventCategoryEvents extends Migration
{
    public function up()
    {
        Schema::create('niainteractive_event_category_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('category_id');
            $table->integer('event_id');
            $table->primary(['category_id','event_id'],'cat_event_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('niainteractive_event_category_events');
    }
}
