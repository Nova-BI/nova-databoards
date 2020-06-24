<?php

namespace Cord\NovaDataboards\Nova\Datavisualables;


use App\Nova\Resource;
use Cord\NovaDataboards\Traits\LoadMorphablesTrait;
use DigitalCreative\InlineMorphTo\HasInlineMorphToFields;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;

class BaseVisual extends Resource
{
    use LoadMorphablesTrait;

    use HasInlineMorphToFields;

    public static $displayInNavigation = false;
    /**
     * @var int sort order of morphables
     */
    public static $sort_order = 1;

    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \Cord\NovaDataboards\Models\Datavisualables\BaseDatavisualables::class;


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
    public static $search = [
        'slug', 'name'
    ];



    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function fields(Request $request)
    {
        $cardWidthAll = (new \Cord\NovaDataboards\Models\Datavisualables\BaseDatavisualables)->getCardWidthAll();
        $cardWidthSupported = $this->newModel()->getCardWidthSupported();
        $cardWidthOptions =  array_intersect_key($cardWidthAll, array_flip($cardWidthSupported));
        return array_merge(
            $this->visualFields($request),
            [
                Select::make(__('Width'), 'card_width')->options($cardWidthOptions)->displayUsingLabels()
                    ->rules('required')
                    ->default('1/3')
            ]
        );
    }

    /**
     * Get the fields displayed by the visual resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function visualFields(Request $request)
    {
        return [];
    }

}
