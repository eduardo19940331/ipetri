<?php

namespace App\Http\Entity;

use Illuminate\Database\Eloquent\Model;

class MenuByUser extends Model
{
    /**
     *
     * @var string
     */
    protected $table = 'menus_by_users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function menu()
    {
        return $this->hasMany(Menu::class, 'id');
    }
}
