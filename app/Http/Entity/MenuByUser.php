<?php

namespace App\Http\Entity;


class MenuByUser extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'menus_by_users';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ['id', 'menu_id', 'user_id', 'status'];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'id');
    }
}
