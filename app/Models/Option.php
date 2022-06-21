<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory, Uuids;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'name',
        'description',
        'image_location'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        //
    ];

    /**
     * The default image storage path.
     *
     * @var string
     */
    public static $imageStoragePath = 'private/images/options';

    /**
     * Bootstrap the model and its traits.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete the image before deleting the option (if exist).
        static::deleting(function ($option) {
            if (isset($option->image_location)) {
                $imagePath = storage_path('app/' . static::$imageStoragePath . '/' . $option->image_location);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        });
    }

    /**
     * Get the event that this option belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the ballots that this option has.
     */
    public function ballots()
    {
        return $this->hasMany(Ballot::class);
    }
}
