<?php

namespace App\Traits;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

trait TimeConverter
{
    /**
     * Convert string time to server time that defined in config.
     *
     * @param string|null $time The time to convert.
     * @param string|null $timezone If `null`, the timezone will be assumed to 'UTC'.
     * @return Carbon|null The converted time, or `null` if the time is `null` or the timezone is invalid.
     */
    public function convertStringTimeToServerTime(?string $time, $timezone = null)
    {
        if (empty($time)) {
            return null;
        }

        try {
            $time = Carbon::parse($time, $timezone);
        } catch (InvalidFormatException $e) {
            return null;
        }

        return $time->setTimezone(config('app.timezone', 'UTC'));
    }
}
