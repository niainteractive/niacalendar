<?php namespace NiaInteractive\NiaCalendar\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'niainteractive_niacalendar_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
