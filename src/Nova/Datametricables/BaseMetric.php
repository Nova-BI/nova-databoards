<?php

namespace Cord\NovaDataboards\Nova\Datametricables;

use App\Nova\Resource;
use Cord\NovaDataboards\Traits\LoadMorphablesTrait;
use DigitalCreative\InlineMorphTo\HasInlineMorphToFields;
use DigitalCreative\InlineMorphTo\InlineMorphTo;
use Illuminate\Http\Request;

class BaseMetric extends Resource
{
    use LoadMorphablesTrait;

    use HasInlineMorphToFields;

    public static $displayInNavigation = false;

    /**
     * @var int sort order of morphables
     */
    public static $sort_order = 1;


    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \Cord\NovaDataboards\Models\Datametricables\BaseDatametricables::class;

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
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function fields(Request $request)
    {
        return array_merge(
            $this->metricFields($request),
            [
                InlineMorphTo::make(__('Visualisation'), 'visualable')
                    ->types($this->loadVisualables())
                    ->default(\App\Nova\Datavisualables\Value::class)
                    ->onlyOnForms()
            ]);
    }


    /**
     * Get the fields displayed by the metric resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function metricFields(Request $request)
    {
        return [];
    }

    /**
     * return the available Visuals for current metric
     *
     * @return  array
     */
    public function loadVisualables()
    {
//        $loadPath = base_path(config('nova-databoards.path') . 'Nova/Datavisualables');
//        $datavisualables = $this->loadMorphables($loadPath);

        $datavisualables = config('nova-databoards.morphables.resources.datavisualables.resources');

        $datavisualables = array_filter($datavisualables, function ($visual) {
            return in_array(class_basename($visual), $this->newModel()->getVisualisationTypes());
        });




        return $datavisualables;
    }
}
