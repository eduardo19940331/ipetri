<?php

namespace App\Http\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseModel extends Model
{
    protected static $tableName = [];

    /**
     * Retorna el nombre de la tabla en la base de datos.
     * @param null $alias
     * @return string
     */
    public static function table($alias = null)
    {
        $className = get_called_class();
        if (!isset(self::$tableName[$className])) {
            /** @var string|self $className */
            self::$tableName[$className] = (new $className())->getTable();
        }
        if ($alias) {
            return DB::raw(self::$tableName[$className] . " AS " . $alias);
        } else {
            return self::$tableName[$className];
        }
    }

    /**
     * @param string $column
     * @param null|string $alias
     * @return string
     */
    public static function col($column, $alias = null, $backtick = false)
    {
        $table = self::table();
        $return = $table . '.' . $column;
        $return = $alias ? $return . " as $alias" : $return;
        if ($backtick) {
            $return = DB::getQueryGrammar()->wrapTable($return);
        }
        return $return;
    }
}
