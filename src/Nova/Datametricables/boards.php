<?php

namespace Cord\NovaDataboards\Nova\Datametricables;

use DigitalCreative\InlineMorphTo\HasInlineMorphToFields;
use Illuminate\Http\Request;

use Laravel\Nova\Fields\Text;

class boards extends BaseMetric
{
    use HasInlineMorphToFields;

    /**
     * @var int sort order of morphables
     */
    public static $sort_order = 2;

    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \Cord\NovaDataboards\Models\Datametricables\boards::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function metricFields(Request $request)
    {
        return [
            Text::make(__('my Board Metric Option'), 'boards_metric_option'),
        ];
    }
}
