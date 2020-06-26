<?php

namespace NovaBI\NovaDataboards\Models\Databoardables;

use NovaBI\NovaDataboards\Models\Databoard;

use NovaBI\NovaDataboards\Traits\HasSchemalessAttributesTrait;
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


    public function filterable()
    {
        return $this->morphTo();
    }
}
