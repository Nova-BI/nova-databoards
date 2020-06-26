<?php

namespace NovaBI\NovaDataboards\Models\Databoardables;


class Standard extends BaseDataboardable
{


    /**
     * Get the displayable label of the scope entity.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Default Databoard');
    }

}
