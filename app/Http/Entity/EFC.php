<?php

namespace App\Http\Entity;

use Illuminate\Database\Eloquent\Model;

class EFC extends Model
{
    /**
     *
     * @var string
     */
    protected $table = 'efc';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
