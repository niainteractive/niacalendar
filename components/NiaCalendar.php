<?php namespace NiaInteractive\NiaCalendar\Components;

use Cms\Classes\ComponentBase;
use NiaInteractive\NiaCalendar\Models\NiaCalendar as NiaCalendarModel;


class NiaCalendar extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'NiaCalendar Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun(){

        $this->addJs('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js');
        $this->addJs('/plugins/niainteractive/niacalendar/assets/vendor/fullcalendar/lib/main.min.js');
        $this->addCss('/plugins/niainteractive/niacalendar/assets/vendor/fullcalendar/lib/main.min.css');

        $all_niacalendars = NiaCalendarModel::where('is_active',1)->get();
        
        $niacalendars = [];
        $i = 0;
        foreach ($all_niacalendars as $key => $record) {
            $niacalendars[$i]['groupId'] = $record->id;
            $niacalendars[$i]['title'] = $record->title;
            $niacalendars[$i]['start'] = $record->start_time->format('Y-m-d H:i');
            if ($record->has_end_date) {
                $niacalendars[$i]['end'] = $record->end_time->format('Y-m-d H:i');
            }else{
                $niacalendars[$i]['end'] = $record->start_time->endOfDay()->format('Y-m-d H:i');
            }
            $niacalendars[$i]['color'] = $record->color ?? 'green' ;
            $niacalendars[$i]['overlap'] = true;
            $niacalendars[$i]['rendering'] = 'background';
            $niacalendars[$i]['url'] = $this->pageUrl('niacalendar-detail',['id' => $record->id]);
            $i++;
        }

        $this->page['niacalendars'] = $niacalendars;
    }
}
