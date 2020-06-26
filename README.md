# Nova Databoards

Analytics Databoards for Laravel Nova

![](docs/nova-databoards-1.gif)

The Benefits of using Nova Databoards compared to the default Nova Metrics:

### Seperation of metric calculation and visualisation

The Nova-Databoards metric classes are the container for all metric calculations. The calculations are adoptable to the supported visualisations, so e.g. within a `Users`-metric you can calculate e.g. the total number of users for a Value-Visualisation or provide Trend-Data for a Trend-Visualisation.

### configurable and re-usable

With custom configurations you can make your Boards, Metrics, Filters and Visualisations re-usable - check out `nova-bi/nova-databoards/src/Models/Datametricables/users.php` how to use the same metric to show the number of total users and users with verified email.

![](docs/nova-databoards-2.gif)

Thanks to [laravel-schemaless-attributes](https://github.com/spatie/laravel-schemaless-attributes) you can add configuration options to your boards, metrics, filters and visualisations without changing the database schema.
 
### filterable and dynamic

By adding the Trait `nova-bi/nova-databoards/src/Traits/DynamicMetricsTrait.php` the Nova-Metrics (or any custom metric card) get filterable 

Thumbs up to [Muzaffer Dede](https://novapackages.com/collaborators/muzafferdede) for developing [Nova Global Filter](https://novapackages.com/packages/nemrutco/nova-global-filter), which is essential for dynamic updates of the widgets on changing filters.


## Table of contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Playground](#playground)
- [Extending](#extending)
- [Roadmap](#roadmap)
- [Known Issues](#known-issues)
- [Changelog](#changelog)
- [License](#license)


## Introduction

Data visualisation is a common business requirement. The default [Nova Metrics](https://nova.laravel.com/docs/3.0/metrics/defining-metrics.html#value-metrics) are providing a simple way to display certain data from your application. 

However the approach to bake metric calculation and visualisation into one file causes limitations if you e.g. want to re-use a metric for segments.

With Nova Metric you would require 3 files to visualize 3 filtered segments of the same KPI e.g.

- Revenue total
- Revenue by region
- Revenue by customer group

In Nova Databoard you would develop 1 filterable datametric with configuration options and different visualisations like Value, Trend, Partition or custom visuals.

Once the datametrics are developed you can configure unlimited widgets and assign them to unlimited databoards.

Databoards are filterable and dynamic - so when changing a filter the widgets are reloads with the new data. 


## Installation

Add the package using composer

    composer require nova-bi/nova-databoards


run Migrations

    php artisan migrate


Add to the `tools()`-method in your `NovaServiceProvider.php` like this:

```php
    use NovaBI\NovaDataboards\NovaDataboards;

    public function tools()
    {
        return [
            new NovaDataboards()
        ];
    }
```


**Recommended:** Publish Configuration File

    php artisan vendor:publish --provider="NovaBI\NovaDataboards\NovaDataboardsServiceProvider" --tag="config"


with `showToolMenu` you can configure if you want to use the Tool Menu default Resource Listing. Set to `false` when using with [Collapsible Resource Manager](https://novapackages.com/packages/digital-creative/collapsible-resource-manager).

    
    
    
**Optional:** Publish Migrations
    
    php artisan vendor:publish --provider="NovaBI\NovaDataboards\NovaDataboardsServiceProvider" --tag="migrations"



## Playground


By default the Playground-Setup is configured, which will give you following basic metrics from you Nova installation:

- Users
- Boards
- Widgets
- ActionEvents

Following visualisations are available (depending on the metric)

- Value
- Trend
- Partition


And these Filters are available.    

- DateFrom
- DateTo
- ActionEventTypes


## Direct Access to Dashboards

After installing the nice [Collapsible Resource Manager](https://novapackages.com/packages/digital-creative/collapsible-resource-manager) package you 

### know issue
- cards are not updating when navigating directly between databoards using [Collapsible Resource Manager
](https://novapackages.com/packages/digital-creative/collapsible-resource-manager), probably an issue of nova framework?



## Extending

### Concept


Separation of Metric Calculation and Visualisation

Nova Databoards follow the Nova concept of Resources to represent Models and are structured as following:

`\Nova\Databoardables` -> `\Models\Databoardables`

`\Nova\Datafilterables` -> `\Models\Datafilterables`

`\Nova\Datametricables` -> `\Models\Datametricables`

`\Nova\Datavisualables` -> `\Models\Datavisualables`


You can place your custom Resources and Models in any subdirectory. To make them available please register in the configuration file `config/nova-databoards.php`. Please follow the Playground examples within the `vendor/nova-bi/nova-databoards/src/`directory.



## Roadmap

- support for custom filter
- data range filter using (https://innologica.github.io/vue2-daterange-picker)
- enhance filter bar with main filters (always visibile) and secondary filters (click on button to add)
- Adding layout flexibility to Nova Cards (e.g. height, sort-order)
- adding visuals, e.g. Chart JS, Google Charts, APEX with common data api
- interactive visuals (todo - click on e.g. a partition will set a filter, which updates all widgets)
- expose metric data through API for external visualisation
- adding ETL for data aggregation
- GUI enhancements
    - select metric with icons / description
    - select visuals with icons / description
    - select filters with icons / description- 
- drag & drop sorting of widgets 


## Known issues

- Sorting relation-ships (Widgets -> Boards) are not supported yet, the order of widgets on a dashboard is natural [Nova Sortable](https://github.com/optimistdigital/nova-sortable).

- 2nd level morphto using [Inline MorphTo Field](https://novapackages.com/packages/digital-creative/nova-inline-morph-to) can be edited, but changes are not stored. Should it be read-only as well? 

- custom filter not showing in global filter card, e.g.
    - https://novapackages.com/packages/ampeco/nova-date-range-filter
    - https://novapackages.com/packages/rcknr/nova-multiselect-filter
    - https://novapackages.com/packages/klepak/nova-multiselect-filter
    - https://novapackages.com/packages/digital-creative/nova-pill-filter


## Credits notice

This package is highly depending on following selection of packages from the huge range of excellent packages for laravel and nova.

- [Collapsible Resource Manager](https://novapackages.com/packages/digital-creative/collapsible-resource-manager)
- [Inline MorphTo Field](https://novapackages.com/packages/digital-creative/nova-inline-morph-to)
- [Nova Field Dependency Container](https://novapackages.com/packages/epartment/nova-dependency-container)
- [Nova Global Filter](https://novapackages.com/packages/nemrutco/nova-global-filter)
- [Nova Sortable](https://novapackages.com/packages/optimistdigital/nova-sortable)
- [Nova Text Card](https://novapackages.com/packages/ericlagarda/nova-text-card)
- [laravel-schemaless-attributes](https://github.com/spatie/laravel-schemaless-attributes)







## License

This software is released under [The MIT License (MIT)](LICENSE).


-