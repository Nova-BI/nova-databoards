<?php
declare(strict_types=1);

return [

    // want to show or hide the default tool menu?
    'showToolMenu' => true,

    'databoardables' => [
        // Todo: make configurable
        'default' => 'todo',
        
        'resources' => [
            \NovaBI\NovaDataboards\Nova\Databoardables\Standard::class, // example databoardable
        ],

        // TODO: load all resources from these paths
        'paths' => [ ]

    ],

    /*
     * register the available filters which can be configured for each dashboard
     */
    'datafilterables' => [
        // Todo: make configurable
        'default' => 'todo',

        'resources' => [
            \NovaBI\NovaDataboards\Nova\Datafilterables\DateFrom::class,
            \NovaBI\NovaDataboards\Nova\Datafilterables\DateTo::class,
            \NovaBI\NovaDataboards\Nova\Datafilterables\ActionEventTypes::class,

        ],

        // TODO: load all resources from these paths
        'paths' => [ ]
    ],

    /*
     * register the available metrics which can be configured for each dashboard
     */

    'datametricables' => [
        // Todo: make configurable
        'default' => 'todo',

        'resources' => [
            \NovaBI\NovaDataboards\Nova\Datametricables\users::class, // example databoardable
            \NovaBI\NovaDataboards\Nova\Datametricables\boards::class, // example databoardable
            \NovaBI\NovaDataboards\Nova\Datametricables\widgets::class, // example databoardable
            \NovaBI\NovaDataboards\Nova\Datametricables\actionEvents::class, // example databoardable
        ],

        // TODO: load all resources from these paths
        'paths' => [ ]
    ],

    /*
     * register the available visuals which can be configured for each metric
     */
    'datavisualables' => [
        // Todo: make configurable
        'default' => 'todo',

        /*
         * by using names you can later re-configure the visualisation for e.g. "Value" when there are new visualisation types available
         * in you metricable the types can be limit with short-names:
         *      var $visualisationTypes = ['Value', 'Trend'];
         */
        'resources' => [
            'Value' => \NovaBI\NovaDataboards\Nova\Datavisualables\Value::class,
            'Trend' => \NovaBI\NovaDataboards\Nova\Datavisualables\Trend::class,
            'Partition' => \NovaBI\NovaDataboards\Nova\Datavisualables\Partition::class
        ],

        // TODO: load all resources from these paths
        'paths' => [ ]
    ],

];