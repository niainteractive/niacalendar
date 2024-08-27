<?php namespace NiaInteractive\NiaCalendar\Components;

use Cms\Classes\ComponentBase;
use NiaInteractive\NiaCalendar\Models\Category;
use NiaInteractive\NiaCalendar\Models\NiaCalendar as NiaCalendarModel;


class NiaCalendarList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'NiaCalendarList Component',
            'description' => 'used to show Events in List'
        ];
    }

    public function defineProperties()
    {

        $categories = Category::lists('name','id');

        return [
            'categories' => [
                'title' => 'Select Categories',
                'type' => 'set',
                'items' => $categories,
            ]
        ];
    }

    public function onRun()
    {
        $query = NiaCalendarModel::where('is_active',1);
        if ($categories = $this->property('categories')) {
            $query->whereHas('categories',function($query) use($categories){
                $query->whereIn('id',$categories);
            });
        }
        $this->page['all_niacalendars'] = $query->get();
    }
}
