<?php namespace NiaInteractive\Event\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use NiaInteractive\Event\Models\Event;

class Events extends Controller
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
        BackendMenu::setContext('NiaInteractive.Event', 'main-menu-nia-events', 'side-menu-nia-events');
    
        $this->addJs('/plugins/niainteractive/event/assets/js/script.js');
    }

    public function calender()
    {
        $this->pageTitle = "Calender";
        BackendMenu::setContext('NiaInteractive.Event', 'main-menu-nia-events', 'side-menu-nia-calender');
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
            $events[$i]['url'] = \Backend::URL('niainteractive/event/events/update/'.$record->id);
            $i++;
        }

        $this->vars['events'] = $events;

    }


}
