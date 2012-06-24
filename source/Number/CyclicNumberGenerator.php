<?php
namespace nicmart\Random\Number;
/**
 * Number Generator based on PHP's rand function
 */

class CyclicNumberGenerator implements NumberGenerator
{
    /**
     * @var array
     */
    private $sequence;

    /**
     * @param array $sequence
     */
    public function __construct(array $sequence = array())
    {
        $this->setSequence($sequence);
    }

    /**
     * Returns the current integer in the sequence. If it is not between $min and $max
     * an Exception is thrown
     *
     * @param int $min
     * @param int $max
     * @throws \OutOfRangeException
     *
     * @return int|mixed
     */
    public function rand($min, $max)
    {
        $n = current($this->sequence);

        if ($n < $min || $n > $max) {
            throw new \OutOfRangeException(
                "The generated number $n is not between $min and $max"
            );
        }

        if (false === next($this->sequence))
            reset($this->sequence);

        return $n;
    }

    /**
     * Returns the max integer supported by the generator
     *
     * @return int
     */
    public function randMax()
    {
        return max($this->getSequence());
    }


    /**
     * @param array $sequence
     *
     * @return CyclicNumberGenerator The current instance
     */
    public function setSequence(array $sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * @return array
     */
    public function getSequence()
    {
        return $this->sequence;
    }
}
