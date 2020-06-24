<?php

namespace Cord\NovaDataboards\Models\Datametricables;


use Cord\NovaDataboards\Models\Datawidget;
use App\Nova\Filters\ActionEventType;
use App\Nova\Filters\DateFilterFrom;
use App\Nova\Filters\DateFilterTo;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\ActionEvent;

class actionEvents extends BaseDatametricables
{
    var $visualisationTypes = ['Value', 'Trend', 'Partition'];

    public static function getResourceModel()
    {
        return \App\Nova\Datametricables\actionEvents::class;
    }

    public function getActionEventsMetricOptionAttribute()
    {
        return $this->extra_attributes->action_events_metric;
    }

    public function setActionEventsMetricOptionAttribute($value)
    {
        $this->extra_attributes->action_events_metric = $value;
    }

    public function calculate(Request $request, $visual)
    {
        switch ($this->visualable_type) {
            case \Cord\NovaDataboards\Models\Datavisualables\Value::class :
                /**
                 * @var $visual \Laravel\Nova\Metrics\Value
                 */
                $request->range = 365 * 100; // otherwise null?

                $filteredModel = $visual->globalFiltered((new ActionEvent)->newQuery(), [
                    DateFilterFrom::class,
                    DateFilterTo::class,
                    ActionEventType::class,
                ]);

                // use internal methods
                return $visual->count($request, $filteredModel)->suffix('Action Events');

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
                $filteredModel = $visual->globalFiltered((new ActionEvent)->newQuery(), [
                    DateFilterFrom::class,
                    DateFilterTo::class,
                    ActionEventType::class,
                ]);
                return $visual->countByDays($request, $filteredModel)->showLatestValue();

                break;

            case \Cord\NovaDataboards\Models\Datavisualables\Partition::class :
                /**
                 * @var $visual \Laravel\Nova\Metrics\Partition
                 */
                $filteredModel = $visual->globalFiltered((new ActionEvent)->newQuery(), [
                    DateFilterFrom::class,
                    DateFilterTo::class,
                    ActionEventType::class,
                ]);
                return $visual->count($request, $filteredModel, 'actionable_type')
                    ->label(function ($value) {
                        switch ($value) {
                            case null:
                                return 'None';
                            default:
                                return ucfirst(($value));
                        }
                    });

                break;

        }
    }
}
