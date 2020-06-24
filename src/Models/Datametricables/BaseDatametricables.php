<?php


namespace Cord\NovaDataboards\Models\Datametricables;

use Cord\NovaDataboards\Models\Databoard;
use Cord\NovaDataboards\Models\Datawidget;
use App\Nova\Filters\DateRangeDefined;
use Cord\NovaDataboards\Traits\HasSchemalessAttributesTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Metrics\TrendResult;
use Illuminate\Http\Request;


class BaseDatametricables extends Model
{
    use HasSchemalessAttributesTrait;

    protected $table = 'datametric_standard';
    public $timestamps = true;

    // supported visuals
    var $visualisationTypes = ['Value', 'Trend', 'Partition'];

    public $casts = [
        'extra_attributes' => 'array',
    ];

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
            case \Cord\NovaDataboards\Models\Datavisualables\Value::class :
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

            case \Cord\NovaDataboards\Models\Datavisualables\Trend::class :

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
