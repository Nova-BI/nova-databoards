<?php

namespace Cord\NovaDataboards\Models\Datavisualables;

class Partition extends BaseDatavisualable
{
    // mapping to visual
    var $visual = \Cord\NovaDataboards\Models\Datavisualables\Visuals\Partition::class;

    // supported card Widths
    var $cardWidthSupported = ['1/3', '2/3', 'full'];

    public static function getResourceModel() {
        return \Cord\NovaDataboards\Nova\Datavisualables\Partition::class;
    }
}
