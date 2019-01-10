<?php
namespace WhilesmartHelpdesk\Events\Models;

use Model;
use Illuminate\Support\Facades\DB;
use WhilesmartHelpdesk\events\classes\Tools;
use DateTimeZone;
use Str;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;


    /*
     * Validation
     */
    public $rules = [
        'name' => 'required|string',
        'start_date' => 'required',
        'close_date' => 'required',
        'slug'     => ['regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:whilesmarthelpdesk_events'],
    ];


    protected $slugs = [
        'slug' => 'title'
    ];

    public $translatable = [
        'title',
        ['slug', 'index' => true],
        'description'
    ];


    public $belongsToMany = [
        'sponsors' => ['WhilesmartHelpdesk\Events\Models\Sponsor',
        'table' => 'whilesmarthelpdesk_event_sponsors',
    ],
    'user' => ['Backend\Models\User']
];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'whilesmarthelpdesk_events';

     /**
     * Check value of some fields
     */
     public function beforeSave()
     {
        $this->slug = Str::slug($this->name);
        if (!isset($this->user_id) || empty($this->user_id)) {
            $this->user_id = 0;
        }
    }

    /**
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     */
    public function setUrl($pageName, $controller)
    {
        $params = [
            'id'   => $this->id,
            'slug' => $this->slug,
        ];

        //expose published year, month and day as URL parameters
        if ($this->published) {
            $params['year'] = $this->published_at->format('Y');
            $params['month'] = $this->published_at->format('m');
            $params['day'] = $this->published_at->format('d');
        }

        return $this->url = $controller->pageUrl($pageName, $params);
    }
}