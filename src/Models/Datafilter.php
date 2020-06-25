<?php
namespace Cord\NovaDataboards\Models;
use Cord\NovaDataboards\Traits\HasSchemalessAttributesTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Datafilter extends Model implements Sortable
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

    protected $table = 'datafilters';
    public $timestamps = true;

    public $translatable = ['description'];

    public function filterable()
    {
        return $this->morphTo();
    }

    public function databoards()
    {
        return $this->belongsToMany(Databoard::class)->orderBy('databoards.sort_order', 'asc');
    }

}
