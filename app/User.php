<?php

namespace App;

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
        $menuData = MenuByUser::where('menus_by_users.user_id', $user)->where('menus_by_users.status', 1)->where('menus_by_users.deleted_at', null)
            ->join('menus', 'menus_by_users.menu_id', '=', 'menus.id')->orderBy('menus.parent_id')->get();
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
        // echo '<pre>';
        // var_dump($menu);
        // echo '</pre>';
        // die();
        return $menu;
    }
}
