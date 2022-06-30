<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
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
        'user_id',
        'title',
        'description',
        'started_at',
        'finished_at',
        'timezone',
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
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_committed' => false,
    ];

    /**
     * Bootstrap the model and its traits.
     */
    protected static function boot()
    {
        parent::boot();

        // Deleting all the ballots, options, and voters when the event is deleted.
        static::deleting(function ($event) {
            $event->ballots->each->delete();
            $event->options->each->delete();
            $event->voters->each->delete();
        });
    }

    /**
     * Override the started_at setter.
     */
    public function setStartedAtAttribute($value)
    {
        $this->attributes['started_at'] = empty($value) ? null : Carbon::parse($value);
    }

    /**
     * Override the finished_at setter.
     */
    public function setFinishedAtAttribute($value)
    {
        $this->attributes['finished_at'] = empty($value) ? null : Carbon::parse($value);
    }

    /**
     * Override the started_at getter.
     *
     * @return Carbon
     */
    public function getStartedAtAttribute()
    {
        if (empty($this->attributes['started_at'])) {
            return null;
        }

        return Carbon::parse($this->attributes['started_at'])->setTimezone($this->attributes['timezone']);
    }

    /**
     * Override the finished_at getter.
     *
     * @return Carbon
     */
    public function getFinishedAtAttribute()
    {
        if (empty($this->attributes['finished_at'])) {
            return null;
        }

        return Carbon::parse($this->attributes['finished_at'])->setTimezone($this->attributes['timezone']);
    }

    /**
     * Get the checklist before commit the event.
     */
    public function getCommitChecklist()
    {
        return [
            [
                'name' => 'The event has a start time after the current time.',
                'is_fulfilled' => $this->started_at && $this->started_at->isFuture(),
            ],
            [
                'name' => 'The event has a finish time after the start time.',
                'is_fulfilled' => $this->finished_at && $this->finished_at->greaterThan($this->started_at),
            ],
            [
                'name' => 'The event has at least two options',
                'is_fulfilled' => $this->options()->count() >= 2,
            ],
            [
                'name' => 'The event has at least two voters',
                'is_fulfilled' => $this->voters()->count() >= 2,
            ],
        ];
    }

    public function isAllCommitChecklistFulfilled()
    {
        foreach ($this->getCommitChecklist() as $checkItem) {
            if (!$checkItem['is_fulfilled']) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the event's creator.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the options of the event.
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    /**
     * Get the voters of the event.
     */
    public function voters()
    {
        return $this->hasMany(Voter::class);
    }

    /**
     * Get the ballots of the event.
     */
    public function ballots()
    {
        return $this->hasMany(Ballot::class);
    }
}
