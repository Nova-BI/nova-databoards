<?php

namespace Cord\NovaDataboards\Models\Databoardables;

use Cord\NovaDataboards\Models\Databoard;

use Cord\NovaDataboards\Traits\HasSchemalessAttributesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class BaseDataboardable extends Model
{
    use HasSchemalessAttributesTrait;

    protected $table = 'databoard_standard';
    public $timestamps = true;

    public $casts = [
        'extra_attributes' => 'array',
    ];

    public static function label()
    {
        return __('Databoard');
    }

    public function databoards()
    {
        return $this->morphMany(Databoard::class, 'databoardable');
    }

}
