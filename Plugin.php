<?php
namespace WhilesmartHelpdesk\Events;
use Event;
use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'whilesmarthelpdesk.events::lang.plugin.name',
            'description' => 'whilesmarthelpdesk.events::lang.plugin.description',
            'author'      => 'whilesmarthelpdesk',
            'icon'        => 'oc-icon-calendar-o',
            'homepage'    => 'https://github.com/WhileSmart/helpdesk-oc-events-plugin'
        ];
    }

    public function registerComponents()
    {
        return[
            'whilesmarthelpdesk\events\Components\Events' => 'events',
            'whilesmarthelpdesk\events\Components\Event' => 'event',
        ];
    }

    public function registerNavigation()
    {
        return [
            'main_navigation' => [
                'label'       => 'whilesmarthelpdesk.events::lang.plugin.name',
                'url'         => Backend::url('whilesmarthelpdesk/events/events'),
                'icon'        => 'oc-icon-calendar-o',
                'permissions' => '',
                'order'       => 500,

                'sideMenu' => [
                    'events' => [
                    'label'       => 'whilesmarthelpdesk.events::lang.menu.events',
                    'icon'        => 'icon-calendar-o',
                    'url'         => Backend::url('whilesmarthelpdesk/events/events'),
                    ],
                    'sponsors' => [
                    'label'       => 'whilesmarthelpdesk.events::lang.menu.sponsors',
                    'url'         => Backend::url('whilesmarthelpdesk/events/sponsors'),
                    'icon'        => 'icon-money',

                    ],
                ]

            ]
        ];
    }

    public function registerSettings()
    {
    }
}
