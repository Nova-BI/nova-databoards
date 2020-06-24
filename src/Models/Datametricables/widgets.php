<?php

namespace Cord\NovaDataboards\Models\Datametricables;


use Cord\NovaDataboards\Models\Datawidget;
use App\Nova\Filters\DateFilterFrom;
use App\Nova\Filters\DateFilterTo;
use Illuminate\Http\Request;

class widgets extends BaseDatametricables
{
    var $visualisationTypes = ['Value', 'Partition'];

    public static function getResourceModel()
    {
        return \App\Nova\Datametricables\widgets::class;
    }

    public function getWidgetsMetricOptionAttribute()
    {
        return $this->extra_attributes->widget_metric_option;
    }

    public function setWidgetsMetricOptionAttribute($value)
    {
        $this->extra_attributes->widget_metric_option = $value;
    }

    public function calculate(Request $request, $visual)
    {
        switch ($this->visualable_type) {
            case \Cord\NovaDataboards\Models\Datavisualables\Value::class :
                /**
                 * @var $visual \Laravel\Nova\Metrics\Value
                 */
                $request->range = 365 * 100; // otherwise null?

                $filteredModel = $visual->globalFiltered((new Datawidget)->newQuery(), [
                    DateFilterFrom::class,
                    DateFilterTo::class,
                ]);

                // use internal methods
                return $visual->count($request, $filteredModel)->suffix('Widgets');

                // calculation
                return $visual
                    ->result($filteredModel->count())
                    ->previous((new Databoard)->count() / 2, 'All')
                    ->prefix('Boards ')
                    ->suffix('for fun')->withoutSuffixInflection();

                break;

            case \Cord\NovaDataboards\Models\Datavisualables\Partition::class :
                /**
                 * @var $visual \Laravel\Nova\Metrics\Partition
                 */
                $filteredModel = $visual->globalFiltered((new Datawidget)->newQuery(), [
                    DateFilterFrom::class,
                    DateFilterTo::class,
                ]);
                return $visual->count($request, $filteredModel, 'metricable_type')
                    ->label(function ($value) {
                        switch ($value) {
                            case null:
                                return 'None';
                            default:
                                return ucfirst(class_basename($value));
                        }
                    });

                break;

        }
    }
}
