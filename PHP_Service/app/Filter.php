<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'filters';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable
        = ['sl_gender', 'sl_min_price', 'sl_max_price', 'sl_color', 'sl_occasion', 'sl_style', 'wg_age', 'wg_min_price',
           'wg_max_price', 'wg_date_from', 'wg_date_to', 'wg_city_id', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
