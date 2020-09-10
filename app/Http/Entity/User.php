<?php

namespace App\Http\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $casts = [
        'fullname' => 'asdnasd',
    ];

    public function FullName()
    {
        return "{$this->name} {$this->surname}";
    }
}
