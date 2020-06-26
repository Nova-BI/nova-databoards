<?php

namespace NovaBI\NovaDataboards\Models;

use NovaBI\NovaDataboards\Traits\HasSchemalessAttributesTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Datawidget extends Model implements Sortable
{
    use SortableTrait;

    use HasSchemalessAttributesTrait;

    public $casts = [
        'extra_attributes' => 'array',
    ];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $table = 'datawidgets';
    public $timestamps = true;

    public $translatable = ['description'];

    public function databoards()
    {
        return $this->belongsToMany(Databoard::class);
    }

    public function metricable()
    {
        return $this->morphTo();
    }

    public function visualable() {
        return $this->metricable->visualable();
    }

}
