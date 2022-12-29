<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

class Performance extends Model
{
    use CrudTrait;
    use Searchable;

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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'performance_date' => 'datetime',
    ];

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

            return;
        }

        $disk = "public";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
        $this->attributes[$attribute_name] = 'storage/' . $this->attributes[$attribute_name];
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // NOTE: only keys are required in order to search with the "database" driver!
        return [
            'name' => $this->name,
            'theaters.name' => '',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id', 'id');
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'performance_tickets', 'performance_id', 'ticket_id');
    }
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
