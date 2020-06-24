<?php

namespace Cord\NovaDataboards;

use Cord\NovaDataboards\Nova\Databoard;
use Cord\NovaDataboards\Nova\Databoardables\Standard;
use Cord\NovaDataboards\Nova\Datawidget;
use Cord\NovaDataboards\Nova\DataboardConfiguration;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaDataboards extends Tool
{

    /**
     * @var mixed
     */
    public $databoardResource = Databoard::class;

    /**
     * @var mixed
     */
    public $databoardConfigurationResource = DataboardConfiguration::class;

    /**
     * @var mixed
     */
    public $datawidgetResource = Datawidget::class;

    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-databoards', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-databoards', __DIR__.'/../dist/css/tool.css');

        Nova::resources([
            $this->databoardResource,
            $this->databoardConfigurationResource,
            $this->datawidgetResource,
            Standard::class
        ]);
        Nova::resources(config('nova-databoards.morphables.resources.databoardables.resources'));
        Nova::resources(config('nova-databoards.morphables.resources.datametricables.resources'));
        Nova::resources(config('nova-databoards.morphables.resources.datavisualables.resources'));
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova-databoards::navigation');
    }
}
