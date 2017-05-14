<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'wishlist_items';

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
    protected $fillable = ['title', 'price', 'image_url', 'product_url', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
