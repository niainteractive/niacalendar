<?php namespace NiaInteractive\Event;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'NiaInteractive\Event\Components\EventList' => 'EventList',
            'NiaInteractive\Event\Components\EventDetail' => 'EventDetail',
            'NiaInteractive\Event\Components\EventCalender' => 'EventCalender',
        ];
    }

}
