<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Performance extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'performances';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($obj) {
            if (isset($obj->poster)) {
                Storage::delete(Str::replaceFirst('storage/', 'public/', $obj->poster));
            }
        });
    }

    public function setPosterAttribute($value)
    {
        $attribute_name = "poster";
        $destination_path = "performances";

        if ($value == null) {
            Storage::delete(Str::replaceFirst('storage/', 'public/', $this->{$attribute_name}));

            $this->attributes[$attribute_name] = null;
        }

        $disk = "public";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
        $this->attributes[$attribute_name] = 'storage/' . $this->attributes[$attribute_name];
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
