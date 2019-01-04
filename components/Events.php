<?php
namespace WhilesmartHelpdesk\Events\Components;

use Cms\Classes\ComponentBase;
use whilesmarthelpdesk\events\Models\Events as Entry;
use Cms\Classes\Page;
use Lang;

class Events extends ComponentBase
{


    public $noPostsMessage;

    public $postPage;

    public $sortOrder;


    public function componentDetails()
    {
        /**
         * Component details.
         */
        return [
            'name'        => 'whilesmarthelpdesk.events::lang.events.name',
            'description' => 'whilesmarthelpdesk.events::lang.events.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'postPage' => [
                'title' => 'whilesmarthelpdesk.events::lang.events.detailpage',
                'description' => 'whilesmarthelpdesk.events::lang.events.detailpagedesc',
                'type' => 'dropdown',
                'default' => '/'
            ],
            'pageNumber' => [
                'title'       => 'whilesmarthelpdesk.events::lang.events.pagination_title',
                'description' => 'whilesmarthelpdesk.events::lang.events.pagination_description',
                'type'        => 'string',
                'default'     => '{{ :page }}'
            ],
            'sortOrder' => [
                'title'       => 'whilesmarthelpdesk.events::lang.settings.posts_order_title',
                'description' => 'whilesmarthelpdesk.events::lang.settings.posts_order_description',
                'type'        => 'dropdown',
                'default'     => 'published_at desc',
                'options'     => [
                    'title asc'         => Lang::get('whilesmarthelpdesk.events::lang.sorting.title_asc'),
                    'title desc'        => Lang::get('whilesmarthelpdesk.events::lang.sorting.title_desc'),
                    'created_at asc'    => Lang::get('whilesmarthelpdesk.events::lang.sorting.created_at_asc'),
                    'created_at desc'   => Lang::get('whilesmarthelpdesk.events::lang.sorting.created_at_desc'),
                    'updated_at asc'    => Lang::get('whilesmarthelpdesk.events::lang.sorting.updated_at_asc'),
                    'updated_at desc'   => Lang::get('whilesmarthelpdesk.events::lang.sorting.updated_at_desc'),
                    'published_at asc'  => Lang::get('whilesmarthelpdesk.events::lang.sorting.published_at_asc'),
                    'published_at desc' => Lang::get('whilesmarthelpdesk.events::lang.sorting.published_at_desc'),
                    'statistics asc'    => Lang::get('whilesmarthelpdesk.events::lang.sorting.statistics_asc'),
                    'statistics desc'   => Lang::get('whilesmarthelpdesk.events::lang.sorting.statistics_desc')
                ]
            ],
            'postsPerPage' => [
                'title'             => 'whilesmarthelpdesk.events::lang.events.per_page_title',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'whilesmarthelpdesk.events::lang.events.per_page_validation',
                'default'           => '10'
            ],
            'noPostsMessage' => [
                'title'             => 'whilesmarthelpdesk.events::lang.events.no_posts_title',
                'description'       => 'whilesmarthelpdesk.events::lang.events.no_posts_description',
                'type'              => 'string',
                'default'           => Lang::get('whilesmarthelpdesk.events::lang.events.no_posts_found'),
                'showExternalParam' => false
            ],
        ];
    }
    public function getPostPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        /**
         * Init component
         */
        $this->prepareVars();
        $this->page['events'] = $this->getEntries();
    }


    protected function prepareVars()
    {
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');
        $this->noPostsMessage = $this->page['noPostsMessage'] = $this->property('noPostsMessage');

        // Page links
        $this->postPage = $this->page['postPage'] = $this->property('postPage');
    }

    public function getEntries() 
    {
        /**
         * Getting entries from database and returning to a partial.
         */
        $result = [];
        $today = date('Y-m-d');
        $events = Entry::where('public', 1)
        ->where('to', '>=', $today)
        ->orderBy('from', 'asc')
        ->orderBy('timefrom', 'desc')
        ->get();

       /*
         * Add a "url" helper attribute for linking to each post and category
         */
        $events->each(function($post) {
            $post->setUrl($this->postPage, $this->controller);
        });
        return $events;
    }
}


    

        