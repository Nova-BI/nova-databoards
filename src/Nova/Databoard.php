<?php

namespace Cord\NovaDataboards\Nova;

use Laravel\Nova\Resource;
use App\Nova\Filters\ActionEventType;
use App\Nova\Filters\DateFilterFrom;
use App\Nova\Filters\DateFilterTo;
use App\Nova\Filters\DateRangeDefined;
use App\Nova\Filters\DateRangePicker;

use Ericlagarda\NovaTextCard\TextCard;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use NrmlCo\NovaBigFilter\NovaBigFilter;
use Timothyasp\Badge\Badge;
use Nemrutco\NovaGlobalFilter;
use Cord\NovaDataboards\Nova\Metrics\UsersPerDay;

class Databoard extends Resource
{
//    public static $displayInNavigation = false;
//    public static $defaultSortField = 'sort_order';

    public static $group = 'Databoard';

    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \Cord\NovaDataboards\Models\Databoard::class;

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
    public static $search = [
        'name'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Databoards');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return  string
     */
    public static function singularLabel()
    {
        return __('Databoard');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function fields(Request $request)
    {
        return [
            Text::make(__('Name'), 'name')->onlyOnIndex()->detailLink()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function cards(Request $request)
    {
        $databoard = Databoard::find($request->resourceId);

        // build header cards
        $headerCards = [
            (new TextCard())
                ->forceFullWidth()
                ->center(false)
                ->height(80)
                ->heading('<h5 class="pl-3 pt-1 font-light">' . __('Databoard') . '</h5><h1 class="pl-3 pb-1 font-light">' . (($databoard) ? $databoard->name : '') . '</h1>')
                ->headingAsHtml()
                ->onlyOnDetail(),

            (new NovaGlobalFilter\NovaGlobalFilter([
                new DateFilterFrom(),
                new DateFilterTo(),
                new ActionEventType()
            ]))
                ->onlyOnDetail()
                ->inline()
            ,
        ];

        $widgetCards = [];

        // collect the data widgets

        if ($databoard) {
            /**
             * @var $databoard \Cord\NovaDataboards\Models\Databoard
             */
            $databoard->datawidgets->each(function ($datawidget, $key) use (&$widgetCards) {
                /**
                 * @var $datawidget Datawidget
                 */
                // set widget id and label as meta data (added to the URI) in \App\Traits\DynamicMetricsTrait::uriKey
                // must be static to map between data request URI and the metric visualisation
                $widgetCards[] = ($datawidget->metricable->visualable->getVisualisation())
                    ->width($datawidget->metricable->visualable->cardWidth)
                    ->withMeta(['widget_id' => $datawidget->id, 'label' => $datawidget->name]);
            });
        }

        return array_merge($headerCards, $widgetCards);
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function filters(Request $request)
    {
        return [
//            new DateRangeDefined(),
//            new DateRangePicker(),
            new ActionEventType()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
