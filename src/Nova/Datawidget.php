<?php

namespace NovaBI\NovaDataboards\Nova;

use Laravel\Nova\Resource;

use NovaBI\NovaDataboards\Nova\Datametricables\myMetric;
use NovaBI\NovaDataboards\Nova\Datavisualables\Value;
use NovaBI\NovaDataboards\Traits\LoadMorphablesTrait;
use Comodolab\Nova\Fields\Help\Help;
use Digitalazgroup\PlainText\PlainText;
use DigitalCreative\InlineMorphTo\InlineMorphTo;
use DigitalCreative\InlineMorphTo\HasInlineMorphToFields;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Saumini\Count\RelationshipCount;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;


use function NovaBI\NovaDataboards\Helpers\Files\getClassesList;


class Datawidget extends Resource
{

//    public static $displayInNavigation = false;

    use HasInlineMorphToFields;

//    use TabsOnEdit;

    use HasSortableRows;

    use LoadMorphablesTrait;

    public static $defaultSortField = 'sort_order';

    public static $group = 'Databoard';


    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \NovaBI\NovaDataboards\Models\Datawidget::class;

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
        'id'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Datawidgets');
    }


    /**
     * Get the displayable singular label of the resource.
     *
     * @return  string
     */
    public static function singularLabel()
    {
        return __('Datawidget');
    }


    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function fields(Request $request)
    {
        /*
        $loadPath = base_path(config('nova-databoards.path') . 'Nova/Datametricables');
        $datametricables = $this->loadMorphables($loadPath);
        $datametricables = array_filter($datametricables, function ($metricable) {
            return class_basename($metricable) != 'BaseMetric';
        });
*/
        $datametricables = config('nova-databoards.datametricables.resources');

//dd($datametricables);
        $fields = [
            InlineMorphTo::make(__('Datametric'), 'metricable')
                ->types($datametricables)
                ->default(''),
            Text::make(__('Visual'), 'visualable', function () {
                return $this->visualable->visual;
            })->hideWhenCreating()->hideWhenUpdating(),
        ];


        return
            array_merge(
                [
                    Text::make(__('Name'), 'name'),
                    Textarea::make(__('Description'), 'description')
                        ->alwaysShow()
                        ->rows(3)
                        ->withMeta(['extraAttributes' => [
                            'placeholder' => __('Provide a short description for internal use')]
                        ])
                        ->help(
                            'Internal Description'
                        ),
                ],
                $fields,
                [
                    RelationshipCount::make('Databoards', 'Databoards')->onlyOnIndex(),
                    (new Tabs('Relations', [
                        'Databoards' => [
                            BelongsToMany::make(__('Databoards'), 'Databoards', DataboardConfiguration::class)->rules('required')

                        ]
                    ]))->defaultSearch(true),
                ]
            );
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function filters(Request $request)
    {
        return [];
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


    /**
     * Get the URI key for the resource.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'databoardWidget';
    }
}
