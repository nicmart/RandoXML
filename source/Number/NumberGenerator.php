<?php
namespace nicmart\Random\Number;

/**
 * NumberGenerator objects generate random integer numbers between a min and a max
 */
interface NumberGenerator
{
    /**
     * Returns an integer between $min and $max
     * @abstract
     * @param int $min
     * @param int $max
     * @return mixed
     */
    public function rand($min, $max);

    /**
     * Returns the max integer supported by the generator
     *
     * @abstract
     * @return int
     */
    public function randMax();
}
