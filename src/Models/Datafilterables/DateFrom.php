<?php

namespace NovaBI\NovaDataboards\Models\Datafilterables;

class DateFrom extends BaseDatafilterable
{
    // mapping to filter
    var $filter = \NovaBI\NovaDataboards\Nova\Filters\DateFilterFrom::class;

    // supported card Widths
    var $cardWidthSupported = ['1/3'];


    public $casts = [
        'extra_attributes' => 'array',
        'default_from' => 'date',
    ];

    public function getDefaultFromAttribute()
    {

        return $this->castAttribute('default_from',$this->extra_attributes->default_from);
    }

    public function setDefaultFromAttribute($value)
    {
        $this->extra_attributes->default_from = $value;
    }

}
