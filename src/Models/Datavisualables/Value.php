<?php

namespace Cord\NovaDataboards\Models\Datavisualables;

class Value extends BaseDatavisualables
{
    // mapping to visual in App\Models\Datavisualables\Visuals
    var $visual = 'Value';

    // supported card Widths
    var $cardWidthSupported = ['1/3'];

    public static function getResourceModel() {
        return \App\Nova\Datavisualables\Value::class;
    }

    public function getMyFirstValueAttribute()
    {
        return $this->extra_attributes->my_first_value;
    }

    public function setMyFirstValueAttribute($value)
    {
        $this->extra_attributes->my_first_value = $value;
    }

}
