<?php

namespace App;

use App\Http\Entity\Menu;
use App\Http\Entity\MenuByUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'firt_name', 'last_name', 'status', 'rut', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function getMenu(): array
    {
        $user = $this->id;
        $menuData = MenuByUser::join(Menu::table(), MenuByUser::col('menu_id'), Menu::col('id'))
        ->where(MenuByUser::col('user_id'), $user)
        ->where(MenuByUser::col('status'), 1)
        ->where(MenuByUser::col('deleted_at'), null)
        ->orderBy(Menu::col('parent_id'))
        ->orderBy(Menu::col('name_menu'))
        ->get();
        
        $menu = [];
        foreach ($menuData as $item) {
            if ($item->parent_id == null) {
                $menu[$item->id] = [
                    '_menu' => $item->name_menu,
                    'icon' => $item->icon,
                ];
            } else {
                $menu[$item->parent_id][$item->url] = [
                    'name' => $item->name_menu,
                    'icon' => $item->icon,
                ];
            }
        }
        
        return $menu;
    }
}
