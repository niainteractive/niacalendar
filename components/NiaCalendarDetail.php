<?php namespace NiaInteractive\NiaCalendar\Components;

use Cms\Classes\ComponentBase;
use NiaInteractive\NiaCalendar\Models\NiaCalendar;

class NiaCalendarDetail extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'NiaCalendarDetail Component',
            'description' => 'No description provided yet...'
        ];
    }

    
    public function getRecord()
    {
        $r = NiaCalendar::where('is_active',1);
        $r->where('id',$this->param('id'));
        return $r->first();
    }

}
