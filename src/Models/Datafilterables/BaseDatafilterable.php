<?php


namespace NovaBI\NovaDataboards\Models\Datafilterables;

use NovaBI\NovaDataboards\Traits\HasSchemalessAttributesTrait;
use Illuminate\Database\Eloquent\Model;


class BaseDatafilterable extends Model
{
    use HasSchemalessAttributesTrait;

    protected $table = 'datafilter_standard';
    public $timestamps = true;

    // mapping to Nova filter
    var $filter;



    public $casts = [
        'extra_attributes' => 'array',
    ];

}
