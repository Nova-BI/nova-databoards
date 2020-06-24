<?php

namespace Cord\NovaDataboards\Models\Datavisualables;

class Partition extends BaseDatavisualables
{
    // mapping to visual in App\Models\Datavisualables\Visuals
    var $visual = 'Partition';

    // supported card Widths
    var $cardWidthSupported = ['1/3', '2/3', 'full'];

    public static function getResourceModel() {
        return \App\Nova\Datavisualables\Partition::class;
    }
}
