<?php
namespace nicmart\Random\Number;
/**
 * Number Generator based on PHP's rand function
 */

class PhpNumberGenerator implements NumberGenerator
{
    /**
     * Returns an integer between $min and $max
     * @param int $min
     * @param int $max
     * @throws \OutOfRangeException
     *
     * @return int|mixed
     */
    public function rand($min, $max)
    {
        if ($min < 0)
            throw new \OutOfRangeException("Min argument must be greater or equal than 0. Was $min.");

        $randmax = getrandmax();

        if ($max > $randmax)
            throw new \OutOfRangeException("Max argument must be smaller or equal than getrandmax ($randmax}. Was $max.");

        return rand($min, $max);
    }

    /**
     * Returns the max integer supported by the generator
     *
     * @return int
     */
    public function randMax()
    {
        return getrandmax();
    }
}
