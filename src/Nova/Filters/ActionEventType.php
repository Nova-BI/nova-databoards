<?php

namespace NovaBI\NovaDataboards\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Actions\ActionEvent;
use Laravel\Nova\Filters\BooleanFilter;

class ActionEventType extends BooleanFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if ($query->getModel()->getTable() == (new ActionEvent)->getTable()) {
            $query = $query->whereIn('actionable_type', array_keys($value));
        }
        return $query;

        /*
         * the long way...
        $eventTypes = $this->eventTypes();
        foreach ($eventTypes as $eventType => $v) {
            if (array_key_exists($eventType, $value)) {
                $query = $query->orWhere('actionable_type', $eventType);
            }
        }
        return $query;
        */

    }

    /**
     * Get the filter's available options.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function options(Request $request)
    {
        $eventTypes = $this->eventTypes();
        return $eventTypes;
    }

    public function eventTypes()
    {
        $actionEventTypes = ActionEvent::select('actionable_type')->distinct()->get();
        $actionEventTypes = $actionEventTypes->groupBy('actionable_type')->keys()->flip()->all();
        return $actionEventTypes;
    }
}
