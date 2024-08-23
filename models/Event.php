<?php namespace NiaInteractive\Event\Models;

use Model;
use Carbon\Carbon;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'niainteractive_event_events';

    /**
     * @var array Validation rules
     */
    public $rules = [
        "title" => 'required',
        "categories" => 'required',
        "start_date" => 'required',
    ];

    public $dates = [
        'start_date',
        'end_date',
        'start_time',
        'end_time',
    ];

    public $customMessages = [
        'end_time.required' => 'The End Date is required.',
        'end_time.after_or_equal' => 'The End Date must be Greater than Start Date.',
    ];

    public function beforeValidate()
    {
        if (app()->runningInBackend() === TRUE) {

            if (isset($this->start_date) && $this->start_date) {
                $start_time = $this->start_date->format('Y-m-d');
                if (isset($this->start_time) && $this->start_time) {
                    $start_time = $this->start_date->format('Y-m-d')." ".$this->start_time->format('H:i');
                }
                $this->start_time = new Carbon($start_time);
            }

            if (isset($this->end_date) && $this->end_date) {
                if (isset($this->end_time) && $this->end_time) {
                    $end_time = $this->end_date->format('Y-m-d')." ".$this->end_time->format('H:i');
                }else{
                    $end_time = $this->end_date->endOfDay()->format('Y-m-d H:i');
                }
                $this->end_time = new Carbon($end_time);
            }

            if ($this->has_end_date == '1') {
                $this->rules['end_time'] = 'required|after_or_equal:start_time';
            }
        }

        $this->rules['description'] = "required";
    }


    public $belongsToMany = [
        'categories' => [
            'NiaInteractive\Event\Models\Category',
            'table'    => 'niainteractive_event_category_events',
        ]
    ];

    public function filterFields($fields, $context = null)
    {
        if (isset($fields->all_day) || isset($fields->has_end_date)) {
            if ($fields->all_day->value == 1 && $fields->has_end_date->value == 1) {
                $fields->start_time->hidden = true;
                $fields->end_time->hidden = true;
                $fields->end_date->hidden = false;
            }elseif($fields->all_day->value == 1 && $fields->has_end_date->value == 0){
                $fields->start_time->hidden = true;
                $fields->end_time->hidden = true;
                $fields->end_date->hidden = true;
            }elseif($fields->all_day->value == 0 && $fields->has_end_date->value == 1){
                $fields->start_time->hidden = false;
                $fields->end_time->hidden = false;
                $fields->end_date->hidden = false;
            }elseif($fields->all_day->value == 0 && $fields->has_end_date->value == 0){
                $fields->start_time->hidden = false;
                $fields->end_time->hidden = true;
                $fields->end_date->hidden = true;
            }
        }
    }

}
