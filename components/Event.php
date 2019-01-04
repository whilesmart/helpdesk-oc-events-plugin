<?php
namespace WhilesmartHelpdesk\Events\Components;

use Cms\Classes\ComponentBase;
use whilesmarthelpdesk\events\Models\Event as Entry;
use Cms\Classes\Page;

class Event extends ComponentBase
{

    public function componentDetails()
    {
        /**
         * Component details.
         */
        return [
            'name' => 'whilesmarthelpdesk.events::lang.event.name',
            'description' => 'whilesmarthelpdesk.events::lang.event.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'whilesmarthelpdesk.events::lang.events.slug_title',
                'description' => 'whilesmarthelpdesk.events::lang.events.slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun()
    {
        /**
         * Init component
         */
        $slug = $this->param('slug');
        $this->page['event'] = $this->getEntry($slug);
    }
    public function getEntry($slug)
    {
        /**
         * Getting entries from database and returning to a partial.
         */
        $result = [];
        $event = Entry::where('public', 1)
            ->where('slug', $slug)
            ->first();

        return $event;
    }
}
