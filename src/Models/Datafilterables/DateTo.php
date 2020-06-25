<?php

namespace Cord\NovaDataboards\Models\Datafilterables;

class DateTo extends BaseDatafilterable
{
    // mapping to filter
    var $filter = \Cord\NovaDataboards\Nova\Filters\DateFilterTo::class;

    // supported card Widths
    var $cardWidthSupported = ['1/3'];


    public $casts = [
        'extra_attributes' => 'array',
        'default_to' => 'date',
    ];

    public function getDefaultToAttribute()
    {

        return $this->castAttribute('default_to',$this->extra_attributes->default_from);
    }

    public function setDefaultToAttribute($value)
    {
        $this->extra_attributes->default_to = $value;
    }

}
