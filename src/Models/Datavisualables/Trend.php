<?php

namespace Cord\NovaDataboards\Models\Datavisualables;

class Trend extends BaseDatavisualables
{
    // mapping to visual in App\Models\Datavisualables\Visuals
    var $visual = 'Trend';

    // supported card Widths
    var $cardWidthSupported = ['1/3', '2/3'];

    public static function getResourceModel() {
        return \App\Nova\Datavisualables\Trend::class;
    }
}
