<?php namespace NiaInteractive\Event\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateNiainteractiveEventCategories extends Migration
{
    public function up()
    {
        Schema::create('niainteractive_event_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('niainteractive_event_categories');
    }
}
