<?php namespace NiaInteractive\NiaCalendar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateNiainteractiveNiaCalendarNiaCalendars extends Migration
{
    public function up()
    {
        Schema::create('niainteractive_niacalendar_niacalendars', function($table)
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
            $table->text('short_description')->nullable();
            $table->boolean('is_active')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('niainteractive_niacalendar_niacalendars');
    }
}
