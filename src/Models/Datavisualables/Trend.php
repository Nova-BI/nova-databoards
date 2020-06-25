<?php

namespace Cord\NovaDataboards\Models\Datavisualables;

class Trend extends BaseDatavisualable
{
    // mapping to visual
    var $visual = \Cord\NovaDataboards\Models\Datavisualables\Visuals\Trend::class;

    // supported card Widths
    var $cardWidthSupported = ['1/3', '2/3'];

    public static function getResourceModel() {
        return \Cord\NovaDataboards\Nova\Datavisualables\Trend::class;
    }
}
