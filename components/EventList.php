<?php namespace NiaInteractive\Event\Components;

use Cms\Classes\ComponentBase;
use NiaInteractive\Event\Models\Event;


class EventList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'EventList Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun(){

        $this->page['all_events'] = Event::where('is_active',1)->get();
    }
}
