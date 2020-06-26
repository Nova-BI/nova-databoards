<?php

namespace NovaBI\NovaDataboards\Models\Datametricables;
use NovaBI\NovaDataboards\Models\Databoard;
use NovaBI\NovaDataboards\Nova\Filters\DateFilterFrom;
use NovaBI\NovaDataboards\Nova\Filters\DateFilterTo;
use Illuminate\Http\Request;

class boards extends BaseDatametricable
{
    /*
     * configure supported visualisationTypes
     * methode 'calculate' must return a valid calculation
     */

    var $visualisationTypes = ['Value', 'Trend'];

    public static function getResourceModel()
    {
        return \NovaBI\NovaDataboards\Nova\Datametricables\boards::class;
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
            case \NovaBI\NovaDataboards\Models\Datavisualables\Value::class :
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

            case \NovaBI\NovaDataboards\Models\Datavisualables\Trend::class :
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
