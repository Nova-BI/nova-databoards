<?php

namespace NovaBI\NovaDataboards\Models\Datavisualables;

class Partition extends BaseDatavisualable
{
    // mapping to visual
    var $visual = \NovaBI\NovaDataboards\Models\Datavisualables\Visuals\Partition::class;

    // supported card Widths
    var $cardWidthSupported = ['1/3', '2/3', 'full'];

    public static function getResourceModel() {
        return \NovaBI\NovaDataboards\Nova\Datavisualables\Partition::class;
    }
}
