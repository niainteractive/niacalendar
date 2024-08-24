<?php namespace NiaInteractive\NiaCalendar;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'NiaInteractive\NiaCalendar\Components\NiaCalendarList' => 'NiaCalendarList',
            'NiaInteractive\NiaCalendar\Components\NiaCalendarDetail' => 'NiaCalendarDetail',
            'NiaInteractive\NiaCalendar\Components\NiaCalendar' => 'NiaCalendar',
        ];
    }

}
