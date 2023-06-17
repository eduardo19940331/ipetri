<?php

namespace App\Http\Entity;

use Illuminate\Database\Eloquent\Model;

class Menu extends BaseModel
{
    /** CONSTANTES DE MENU */
    public const ADMINISTRACION = 1;
    public const ADMIN_USERS    = 2;
    public const EFC            = 3;
    public const CURSOS_EFC     = 4;

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

    protected $fillable = [
        'id',
        'name_menu',
        'icon',
        'url',
        'parent_id'
    ];

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function menus_by_users()
    {
        return $this->hasMany(MenuByUser::class);
    }
}
