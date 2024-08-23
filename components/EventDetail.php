<?php namespace NiaInteractive\Event\Components;

use Cms\Classes\ComponentBase;
use NiaInteractive\Event\Models\Event;

class EventDetail extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'EventDetail Component',
            'description' => 'No description provided yet...'
        ];
    }

    
    public function getRecord()
    {
        $r = Event::where('is_active',1);
        $r->where('id',$this->param('id'));
        return $r->first();
    }

}
