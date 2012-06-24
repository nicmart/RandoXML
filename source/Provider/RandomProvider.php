<?php
namespace nicmart\Random\Provider;

use nicmart\Random\Provider\Provider;
use nicmart\Random\Number\NumberGenerator;
use nicmart\Random\Number\PhpNumberGenerator;

/**
 * This class picks randomly a string from a fixed collection of strings
 */
class RandomProvider implements Provider
{
    /**
     * @var array
     */
    private $strings;

    /**
     * @var NumberGenerator
     */
    private $numberGenerator;

    /**
     * Get a random string
     *
     * @return string
     */
    public function get()
    {
        $strings = $this->getPlainStrings();
        $key = array_rand($strings);

        return $strings[$key];
    }

    /**
     * Add an array of strings. Each array item can be a plain string or an array with
     * two elements, the string and the probabilistic weight for that string
     *
     * @param array $stringsAndWeights
     */
    public function addStrings(array $stringsAndWeights)
    {
        foreach ($stringsAndWeights as $stringAndWeight) {
            if (!is_array($stringAndWeight)) {
                $stringAndWeight = array($stringAndWeight, 1);
            }
            list($string, $weight) = $stringAndWeight;

            $this->addString($string, $weight);
        }
    }

    /**
     * @param $string The string to add
     * @param int $weight The probabilistic weight of this string
     *
     * @return RandomSource the current instance
     */
    public function addString($string, $weight = 1)
    {
        $this->strings[] = array($string, $weight);

        return $this;
    }

    /**
     * Return the array of strings withought the probabilistic weights
     *
     * @return array The array of strings
     */
    public function getPlainStrings()
    {
       return array_map(function($item){
               return $item[0];
       }, $this->strings);
    }

    /**
     * The array of the weighted strings
     *
     * @return array
     */
    public function getStrings()
    {
        return $this->strings;
    }

    /**
     * @param NumberGenerator $numberGenerator
     *
     * @return \nicmart\Random\String\RandomSource The current instance
     */
    public function setNumberGenerator(NumberGenerator $numberGenerator)
    {
        $this->numberGenerator = $numberGenerator;

        return $this;
    }

    /**
     * @return \nicmart\Random\Number\NumberGenerator
     */
    public function getNumberGenerator()
    {
        if (!isset($this->numberGenerator)) {
            $this->numberGenerator = new PhpNumberGenerator;
        }

        return $this->numberGenerator;
    }

}