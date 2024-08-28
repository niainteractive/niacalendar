<?php namespace NiaInteractive\NiaCalendar\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use NiaInteractive\NiaCalendar\Models\Category;
use NiaInteractive\NiaCalendar\Models\NiaCalendar as NiaCalendarModel;


class NiaCalendar extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'NiaCalendar Component',
            'description' => 'used to show Events in calender'
        ];
    }

    public function defineProperties()
    {

        $categories = Category::lists('name','id');

        return [
            'categories' => [
                'title' => 'Categories',
                'type' => 'set',
                'items' => $categories,
            ],
            'eventPageDetail' => [
                'title' => 'Event Detail Page',
                'type' => 'dropdown',
                'default' => 'niacalendar-detail'
            ]
        ];
    }

    public function getEventPageDetailOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->addJs('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js');
        $this->addJs('//cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js');

        $query = NiaCalendarModel::where('is_active',1);
        if ($categories = $this->property('categories')) {
            $query->whereHas('categories',function($query) use($categories){
                $query->whereIn('id',$categories);
            });
        }

        $all_niacalendars = $query->get();

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
            $niacalendars[$i]['url'] = $this->pageUrl($this->property('eventPageDetail'),['id' => $record->id]);
            $i++;
        }

        $this->page['niacalendars'] = $niacalendars;
    }
}
