<?php

namespace Cord\NovaDataboards\Models\Datavisualables;

class Value extends BaseDatavisualable
{
    // mapping to visual
    var $visual = \Cord\NovaDataboards\Models\Datavisualables\Visuals\Value::class;

    // supported card Widths
    var $cardWidthSupported = ['1/3'];

    public static function getResourceModel() {
        return \Cord\NovaDataboards\Nova\Datavisualables\Value::class;
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
