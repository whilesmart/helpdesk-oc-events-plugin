<?php
namespace WhilesmartHelpdesk\Events\Models;

use Model;

/**
 * Model
 */
class Sponsor extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'whilesmarthelpdesk_sponsors';

    /**
     * @var array Validation rules
     */
      public $rules = [
        'name' => 'required|string',
    ];

    public $belongsToMany = [
        'events' => ['WhilesmartHelpdesk\Events\Models\Event',
            'table' => 'whilesmarthelpdesk_event_sponsors',
        ]
    ];

}
