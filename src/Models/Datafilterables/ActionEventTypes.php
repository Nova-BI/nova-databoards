<?php

namespace NovaBI\NovaDataboards\Models\Datafilterables;

class ActionEventTypes extends BaseDatafilterable
{
    // mapping to filter
    var $filter = \NovaBI\NovaDataboards\Nova\Filters\ActionEventType::class;

    // supported card Widths
    var $cardWidthSupported = ['1/3'];


    public function getFilterValuesAttribute()
    {
        return $this->extra_attributes->filterValues;
    }

    public function setFilterValuesAttribute($value)
    {
        $this->extra_attributes->filterValues = $value;
    }

}
