<?php

namespace Cord\NovaDataboards\Models\Datametricables;
use Cord\NovaDataboards\Models\Databoard;
use App\Nova\Filters\DateFilterFrom;
use App\Nova\Filters\DateFilterTo;
use App\Nova\Filters\DateRangeDefined;
use App\Nova\Filters\DateRangePicker;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\TrendResult;

class boards extends BaseDatametricables
{
    var $visualisationTypes = ['Value', 'Trend'];

    public static function getResourceModel()
    {
        return \App\Nova\Datametricables\boards::class;
    }

    public function getBoardsMetricOptionAttribute()
    {
        return $this->extra_attributes->boards_metric_option;
    }


    public function setBoardsMetricOptionAttribute($value)
    {
        $this->extra_attributes->boards_metric_option = $value;
    }


    public function calculate(Request $request, $visual)
    {
        switch ($this->visualable_type) {
            case \Cord\NovaDataboards\Models\Datavisualables\Value::class :
                /**
                 * @var $visual \Laravel\Nova\Metrics\Value
                 */
                $request->range = 365 * 100; // otherwise null?

                $filteredModel = $visual->globalFiltered((new Databoard)->newQuery(), [
                    DateFilterFrom::class,
                    DateFilterTo::class,
                ]);

                // use internal methods
                return $visual->count($request, $filteredModel)->suffix('Boards');

                // calculation
                return $visual
                    ->result($filteredModel->count())
                    ->previous((new Databoard)->count() / 2, 'All')
                    ->prefix('Boards ')
                    ->suffix('for fun')->withoutSuffixInflection();

                break;

            case \Cord\NovaDataboards\Models\Datavisualables\Trend::class :
                /**
                 * @var $visual \Laravel\Nova\Metrics\Trend
                 */
                $filteredModel = $visual->globalFiltered((new Databoard)->newQuery(), [
                    DateFilterFrom::class,
                    DateFilterTo::class,
                ]);
                return $visual->countByDays($request, $filteredModel)->showLatestValue();

                break;

        }
    }

}
