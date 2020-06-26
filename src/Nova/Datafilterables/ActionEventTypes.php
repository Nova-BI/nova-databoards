<?php

namespace NovaBI\NovaDataboards\Nova\Datafilterables;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;

class ActionEventTypes extends BaseFilter
{
    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \NovaBI\NovaDataboards\Models\Datafilterables\ActionEventTypes::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function filterFields(Request $request)
    {
        return [
        ];
    }
}
