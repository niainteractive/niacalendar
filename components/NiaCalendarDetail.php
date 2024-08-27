<?php namespace NiaInteractive\NiaCalendar\Components;

use Cms\Classes\ComponentBase;
use NiaInteractive\NiaCalendar\Models\NiaCalendar;

class NiaCalendarDetail extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'NiaCalendarDetail Component',
            'description' => 'used to show Event in detail'
        ];
    }

    public function onRun(){
        $id = $this->param('id');
        $this->page['niacalendar'] = NiaCalendar::where('is_active',1)
        ->where('id',$id)
        ->first();
        
        if (!$this->page['niacalendar']) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }
    }
    

}
