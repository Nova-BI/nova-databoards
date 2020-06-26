<?php

namespace NovaBI\NovaDataboards\Models\Datavisualables\Visuals;

use NovaBI\NovaDataboards\Traits\DynamicMetricsTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition as BasePartition;
use Nemrutco\NovaGlobalFilter\GlobalFilterable;

class Partition extends BasePartition
{
    use DynamicMetricsTrait;
    use GlobalFilterable;

    var $baseUriKey = 'partition';

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
