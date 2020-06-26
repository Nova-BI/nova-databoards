# Nova Databoards

Analytics Databoards for Laravel Nova



Publish Configuration File

    php artisan vendor:publish --provider="NovaBI\NovaDataboards\NovaDataboardsServiceProvider" --tag="config"
    
    
Publish Migrations
    
    php artisan vendor:publish --provider="NovaBI\NovaDataboards\NovaDataboardsServiceProvider" --tag="migrations"



## Playground

By default the Playground is configured, which will give you following Metrics:

- Users
- Boards
- Widgets
- ActionEvents

Following visualisations are available (depending on the Metric)

- Value
- Trend
- Partition


And these Filters are available.    

- DateFrom
- DateTo
- ActionEventTypes





## Credits notice

This boilerplate is highly depending on following selection of packages from the huge range of excellent packages for laravel and nova.

- [Collapsible Resource Manager](https://novapackages.com/packages/digital-creative/collapsible-resource-manager)
- [Inline MorphTo Field](https://novapackages.com/packages/digital-creative/nova-inline-morph-to)
- [Nova Field Dependency Container](https://novapackages.com/packages/epartment/nova-dependency-container)
- [Nova Global Filter](https://novapackages.com/packages/nemrutco/nova-global-filter)
- [Nova Sortable](https://novapackages.com/packages/optimistdigital/nova-sortable)
- [Nova Text Card](https://novapackages.com/packages/ericlagarda/nova-text-card)
- [laravel-schemaless-attributes](https://github.com/spatie/laravel-schemaless-attributes)



## Table of contents

- [Introduction](#introduction)
- [Roadmap](#roadmap)
- [Known Issues](#known-issues)
- [Installation](#installation)
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


## Roadmap

- support for custom filter
- data range filter using (https://innologica.github.io/vue2-daterange-picker)
- enhance filter bar with main filters (always visibile) and secondary filters (click on button to add)
- Adding layout flexibility to Nova Cards (e.g. height, sort-order)
- adding visuals, e.g. APEX, Chart JS, Google Charts with common data api
- interactive visuals (todo - click on e.g. a partition will set a filter, which updates all widgets)
- expose metric data through API for external visualisation
- adding ETL for data aggregation
- GUI enhancements
    - select metric with icons / description
    - select visuals with icons / description
- drag & drop sorting of widgets 


## Known issues

- Sorting relation-ships (Widgets -> Boards) are not supported yet, the order of widgets on a dashboard is natural [Nova Sortable](https://github.com/optimistdigital/nova-sortable).
- cards are not updating when navigating directly between databoards using [Collapsible Resource Manager
](https://novapackages.com/packages/digital-creative/collapsible-resource-manager), probably an issue of nova framework?
- 2nd level morphto using [Inline MorphTo Field](https://novapackages.com/packages/digital-creative/nova-inline-morph-to) can be edited, but changes are not stored. Should it be read-only as well? 
- custom filter not showing in global filter card, e.g.
    - https://novapackages.com/packages/ampeco/nova-date-range-filter
    - https://novapackages.com/packages/rcknr/nova-multiselect-filter
    - https://novapackages.com/packages/klepak/nova-multiselect-filter
    - https://novapackages.com/packages/digital-creative/nova-pill-filter



## Installation

Currently this is


## Extending

### Concept


Separation of Metric Calculation and Visualisation

`App\Models`

`App\Models\Databoardables`
`App\Models\Datametricables`
`App\Models\Datavisualables`

### Adding custom Metrics

### Adding custom Visuals

You can easily add your own visuals, which are defined by a Model, a Card and a Nova Resource. Just go through the code of the Value Visual:



#### Model


    app/Models/Datavisualables/Value.php
    
```php
namespace App\Models\Datavisualables;

class Value extends BaseDatavisualables
{
    // mapping to visual in App\Models\Datavisualables\Visuals
    var $visual = 'Value';

    // supported card Widths
    var $cardWidthSupported = ['1/3'];

    public static function getResourceModel() {
        return \App\Nova\Datavisualables\Value::class;
    }
}
```    
        
    app/Models/Datavisualables/Visuals/Value.php
    
```php
namespace App\Models\Datavisualables\Visuals;

use App\Traits\DynamicMetricsTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value as BaseValue;
use Nemrutco\NovaGlobalFilter\GlobalFilterable;

class Value extends BaseValue
{
    use DynamicMetricsTrait;
    use GlobalFilterable;

    var $baseUriKey = 'value';

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->metricCalculate($request, $this);
    }
}

```           

#### Resource

In `app/Nova/Datavisualables/Value.php` you can define the Nova Resource with optional configurations.
    
```php
namespace App\Nova\Datavisualables;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;


class Value extends BaseVisual
{
    /**
     * @var int sort order of morphables
     */
    public static $sort_order = 1;

    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \App\Models\Datavisualables\Value::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var  string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var  array
     */
    public static $search = [];

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Value');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return  string
     */
    public static function singularLabel()
    {
        return __('Value');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function visualFields(Request $request)
    {
        return [
            Text::make(__('my First Value'), 'my_first_value'),
        ];
    }
}
```    
    










## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2016-2020 Rinvex LLC, Some rights reserved.

