<?php


namespace Cord\NovaDataboards\Models\Datavisualables;

use Cord\NovaDataboards\Models\Datametricables\BaseDatametricables;
use Cord\NovaDataboards\Traits\HasSchemalessAttributesTrait;
use Illuminate\Database\Eloquent\Model;


class BaseDatavisualables extends Model
{
    use HasSchemalessAttributesTrait;

    protected $table = 'datavisual_standard';
    public $timestamps = true;

    // mapping to visual in App\Models\Datavisualables\Visuals
    var $visual = 'Value';

    public $casts = [
        'extra_attributes' => 'array',
    ];

    // all available card Widths
    var $cardWidthAll = ['1/3' => '1/3 width', '2/3' => '2/3 width', 'full' => 'full Width'];

    // supported card Widths
    var $cardWidthSupported = ['1/3', '2/3', 'full'];

    public function metrics()
    {
        return $this->morphMany(BaseDatametricables::class, 'visualables');
    }

    public function getVisualisation()
    {
        $classname = "\\App\\Models\\Datavisualables\\visuals\\" . $this->visual;
        return (new $classname())->onlyOnDetail();
    }

    /**
     * @return string[]
     */
    public function getCardWidthAll(): array
    {
        return $this->cardWidthAll;
    }

    /**
     * @return string[]
     */
    public function getCardWidthSupported(): array
    {
        return $this->cardWidthSupported;
    }

    public function setCardWidthAttribute($value)
    {
        $this->extra_attributes->card_width = $value;
    }

    public function getCardWidthAttribute()
    {
        return $this->extra_attributes->card_width;
    }


    // examples for custom attributes

    public function getMyFirstValueAttribute()
    {
        return $this->extra_attributes->my_first_value;
    }


    public function setMyFirstValueAttribute($value)
    {
        $this->extra_attributes->my_first_value = $value;
    }


    public function getMySecondValueAttribute()
    {
        return $this->extra_attributes->my_second_value;
    }


    public function setMySecondValueAttribute($value)
    {
        $this->extra_attributes->my_second_value = $value;
    }
}
