<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

/**
 *
 */
class DateTimeCustomHoursRule implements Rule
{
    /**
     * @var int $hours
     */
    private int $hours;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $hours = 24)
    {
        $this->hours = $hours;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $diffSeconds = Carbon::now()->diffInSeconds(Carbon::parse($value));

        return $diffSeconds / 60 / 60 < $this->hours;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Lifetime more than 24 hours';
    }
}
