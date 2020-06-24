<?php

namespace Cord\NovaDataboards\Models\Datavisualables\Visuals;

use Cord\NovaDataboards\Traits\DynamicMetricsTrait;
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
