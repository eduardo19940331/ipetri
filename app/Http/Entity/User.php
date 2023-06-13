<?php

namespace App\Http\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends BaseModel
{
    /**
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $casts = [
        'fullname' => '',
    ];

    public function FullName()
    {
        return "{$this->name} {$this->surname}";
    }
}
