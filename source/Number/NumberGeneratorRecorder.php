<?php
namespace nicmart\Random\Number;

use nicmart\Random\Number\NumberGenerator;

/**
 * A Decorator class built around another Generator that can record the
 * returns value of that generator.
 */

class NumberGeneratorRecorder implements NumberGenerator
{
    /**
     * @var NumberGenerator
     */
    private $generator;

    /**
     * @var array
     */
    private $recording;

    /**
     * @param NumberGenerator $generator
     */
    public function __construct(NumberGenerator $generator)
    {
        $this->generator = $generator;
    }


    /**
     * Returns an integer between $min and $max
     *
     * @param int $min
     * @param int $max
     * @return mixed
     */
    public function rand($min, $max)
    {
        $n = $this->generator->rand($min, $max);

        $this->recording[] = $n;

        return $n;
    }

    /**
     * Get the recorded sequence
     *
     * @return array
     */
    public function getRecording()
    {
        return $this->recording;
    }

    /**
     * @return NumberGenerator
     */
    public function getNumberGenerator()
    {
        return $this->generator;
    }

}
