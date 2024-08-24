<?php namespace NiaInteractive\NiaCalendar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateNiainteractiveNiaCalendarCategoryNiaCalendars extends Migration
{
    public function up()
    {
        Schema::create('niainteractive_niacalendar_category_niacalendars', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('category_id');
            $table->integer('niacalendar_id');
            $table->primary(['category_id','niacalendar_id'],'cate_calendar_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('niainteractive_niacalendar_category_niacalendars');
    }
}
