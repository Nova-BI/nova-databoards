<?php

namespace NovaBI\NovaDataboards\Models\Datavisualables;

class Trend extends BaseDatavisualable
{
    // mapping to visual
    var $visual = \NovaBI\NovaDataboards\Models\Datavisualables\Visuals\Trend::class;

    // supported card Widths
    var $cardWidthSupported = ['1/3', '2/3'];

    public static function getResourceModel() {
        return \NovaBI\NovaDataboards\Nova\Datavisualables\Trend::class;
    }
}
