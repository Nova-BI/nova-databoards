<?php

namespace NovaBI\NovaDataboards\Nova\Datavisualables;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;


class Trend extends BaseVisual
{
    /**
     * @var int sort order of morphables
     */
    public static $sort_order = 3;
    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \NovaBI\NovaDataboards\Models\Datavisualables\Trend::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var  string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var  array
     */
    public static $search = [];

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Trend');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return  string
     */
    public static function singularLabel()
    {
        return __('Trend');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function visualFields(Request $request)
    {
        return [
            Text::make(__('my First Value'), 'my_first_value'),
            Text::make(__('my Second Value'), 'my_second_value'),
        ];
    }
}
