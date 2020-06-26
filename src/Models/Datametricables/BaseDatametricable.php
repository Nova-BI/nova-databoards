<?php


namespace NovaBI\NovaDataboards\Models\Datametricables;

use NovaBI\NovaDataboards\Models\Databoard;
use NovaBI\NovaDataboards\Models\Datavisualables\Partition;
use NovaBI\NovaDataboards\Models\Datavisualables\Trend;
use NovaBI\NovaDataboards\Models\Datavisualables\Value;
use NovaBI\NovaDataboards\Models\Datawidget;
use NovaBI\NovaDataboards\Nova\Filters\DateRangeDefined;
use NovaBI\NovaDataboards\Traits\HasSchemalessAttributesTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Metrics\TrendResult;
use Illuminate\Http\Request;


class BaseDatametricable extends Model
{
    use HasSchemalessAttributesTrait;

    protected $table = 'datametric_standard';
    public $timestamps = true;

    // supported visuals
    var $visualisationTypes = [];

    public $casts = [
        'extra_attributes' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }

    /**
     * @return string[]
     */
    public function getVisualisationTypes(): array
    {
        return $this->visualisationTypes;
    }


    public function datawidgets()
    {
        return $this->morphMany(Datawidget::class, 'metricable');
    }

    public function visualable()
    {
        return $this->morphTo();
    }


    public function calculate(Request $request, $visual)
    {

        switch ($this->visualable_type) {
            case \NovaBI\NovaDataboards\Models\Datavisualables\Value::class :
                /**
                 * @var $visual \Laravel\Nova\Metrics\Value
                 */

                $filteredModel = $visual->globalFiltered((new Datawidget)->newQuery(), [
                    DateRangeDefined::class // DateFilter
                ]);

                // use internal methods
                //  return $visual->count($request, $filteredModel)->suffix('Widgets');

                // calculation
                return $visual
                    ->result($filteredModel->count())
                    ->previous((new Datawidget)->count() / 2, 'All')
                    ->prefix('Widgets ')
                    ->suffix('for fun')->withoutSuffixInflection()
                    ;

                break;

            case \NovaBI\NovaDataboards\Models\Datavisualables\Trend::class :

                /**
                 * @var $visual \Laravel\Nova\Metrics\Trend
                 */
                return (new TrendResult)->trend([
                    'July 1' => 100,
                    'July 2' => 75,
                    'July 3' => 125,
                    'July 4' => 85,
                    'July 5' => 150,
                ]);
                break;
        }
    }
}
