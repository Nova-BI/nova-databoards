<?php

namespace Cord\NovaDataboards\Models\Datavisualables\Visuals;

use Cord\NovaDataboards\Traits\DynamicMetricsTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Trend as BaseTrend;
use Nemrutco\NovaGlobalFilter\GlobalFilterable;

class Trend extends BaseTrend
{
    use DynamicMetricsTrait;
    use GlobalFilterable;

    var $baseUriKey = 'trend';
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

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        // access widget object
//        dd($this->widget());
        return [
            30 => '30 Days',
            60 => '60 Days',
            90 => '90 Days',
        ];
    }

}
