<?php

namespace App\Http\Entity;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     *
     * @var string
     */
    protected $table = 'menus';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function menus_by_users()
    {
        return $this->hasMany(MenuByUser::class);
    }
}
