<?php namespace NiaInteractive\NiaCalendar\Components;

use Cms\Classes\ComponentBase;
use NiaInteractive\NiaCalendar\Models\NiaCalendar;


class NiaCalendarList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'NiaCalendarList Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun(){

        $this->page['all_niacalendars'] = NiaCalendar::where('is_active',1)->get();
    }
}
