<?php
declare(strict_types=1);


return [
    // Manage autoload migrations
    'autoload_migrations' => true,

    'databoardables' => [
        'default' => 'todo',
        
        'resources' => [
            \NovaBI\NovaDataboards\Nova\Databoardables\Standard::class, // example databoardable
        ],
        // load all resources from this path
        'paths' => [
        ]

    ],

    /*
     * register the available filters which can be configured for each dashboard
     */
    'datafilterables' => [
        'default' => 'todo',

        'resources' => [
            \NovaBI\NovaDataboards\Nova\Datafilterables\DateFrom::class,
            \NovaBI\NovaDataboards\Nova\Datafilterables\DateTo::class,
            \NovaBI\NovaDataboards\Nova\Datafilterables\ActionEventTypes::class,

        ],
        // load all resources from this path
        'paths' => [
        ]
    ],

    /*
     * register the available metrics which can be configured for each dashboard
     */
    'datametricables' => [
        'default' => 'todo',

        'resources' => [
            \NovaBI\NovaDataboards\Nova\Datametricables\users::class, // example databoardable
            \NovaBI\NovaDataboards\Nova\Datametricables\boards::class, // example databoardable
            \NovaBI\NovaDataboards\Nova\Datametricables\widgets::class, // example databoardable
            \NovaBI\NovaDataboards\Nova\Datametricables\actionEvents::class, // example databoardable
        ],
        // load all resources from this path
        'paths' => [
        ]
    ],

    /*
     * register the available visuals which can be configured for each metric
     */
    'datavisualables' => [
        'default' => 'todo',

        /*
         * by using names you can later re-configure the visualisation for e.g. "Value" when there are new visualisation types available
         */
        'resources' => [
            'Value' => \NovaBI\NovaDataboards\Nova\Datavisualables\Value::class,
            'Trend' => \NovaBI\NovaDataboards\Nova\Datavisualables\Trend::class,
            'Partition' => \NovaBI\NovaDataboards\Nova\Datavisualables\Partition::class
        ],
        // load all resources from this path
        'paths' => [
        ]
    ],

];