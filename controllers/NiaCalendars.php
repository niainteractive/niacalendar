<?php namespace NiaInteractive\NiaCalendar\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use NiaInteractive\NiaCalendar\Models\NiaCalendar;

class NiaCalendars extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('NiaInteractive.NiaCalendar', 'main-menu-nia-niacalendars', 'side-menu-nia-niacalendars');
    
        $this->addJs('/plugins/niainteractive/niacalendar/assets/js/script.js');
    }

    public function calender()
    {
        $this->pageTitle = "Calender";
        BackendMenu::setContext('NiaInteractive.NiaCalendar', 'main-menu-nia-niacalendars', 'side-menu-nia-calender');
        $this->addJs('//cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js');
        $all_niacalendars = NiaCalendar::where('is_active',1)->get();
        
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
            $niacalendars[$i]['color'] = $record->categories->value('color') ?? 'green' ;
            $niacalendars[$i]['overlap'] = true;
            $niacalendars[$i]['rendering'] = 'background';
            $niacalendars[$i]['url'] = \Backend::URL('niainteractive/niacalendar/niacalendars/update/'.$record->id);
            $i++;
        }

        $this->vars['niacalendars'] = $niacalendars;

    }


}
