<?php namespace NiaInteractive\Event\Components;

use Cms\Classes\ComponentBase;
use NiaInteractive\Event\Models\Event;


class EventCalender extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'EventCalender Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun(){
        $this->addJs('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js');
        $this->addJs('/plugins/niainteractive/event/assets/vendor/fullcalendar/lib/main.min.js');
        $this->addCss('/plugins/niainteractive/event/assets/vendor/fullcalendar/lib/main.min.css');

        $all_events = Event::where('is_active',1)->get();
        
        $events = [];
        $i = 0;
        foreach ($all_events as $key => $record) {
            $events[$i]['groupId'] = $record->id;
            $events[$i]['title'] = $record->title;
            $events[$i]['start'] = $record->start_time->format('Y-m-d H:i');
            if ($record->has_end_date) {
                $events[$i]['end'] = $record->end_time->format('Y-m-d H:i');
            }else{
                $events[$i]['end'] = $record->start_time->endOfDay()->format('Y-m-d H:i');
            }
            $events[$i]['color'] = $record->color ?? 'green' ;
            $events[$i]['overlap'] = true;
            $events[$i]['rendering'] = 'background';
            $events[$i]['url'] = $this->pageUrl('event-detail',['id' => $record->id]);
            $i++;
        }

        $this->page['events'] = $events;
    }
}
