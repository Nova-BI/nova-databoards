<?php

namespace NovaBI\NovaDataboards\Models;

use Rinvex\Attributes\Traits\Attributable;
use Rinvex\Support\Traits\HasTranslations as HasTranslations;
use App\Traits\DynamicMetricsTrait;

class Model extends \Illuminate\Database\Eloquent\Model
{

    public $timestamps = true;

    use Attributable, HasTranslations {
        Attributable::setAttribute insteadof HasTranslations;
    }

    protected $rules = [];

    public $translatable = [];

    public static $defaultSortField = 'sort_order';

}
