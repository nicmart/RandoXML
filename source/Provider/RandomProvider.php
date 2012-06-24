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
    private $choices;

    /**
     * @var NumberGenerator
     */
    private $numberGenerator;

    /**
     * Get a random choice
     *
     * @return mixed
     */
    public function get()
    {
        $choices = $this->getChoices();

        $strings = $this->getPlainChoices();
        $key = $this->getNumberGenerator()->rand(0, count($choices) - 1);

        return $strings[$key];
    }

    /**
     * Add an array of strings. Each array item can be a plain string or an array with
     * two elements, the string and the probabilistic weight for that string
     *
     * @param array $choicesAndWeights
     *
     * @return RandomProvider
     */
    public function addChoices(array $choicesAndWeights)
    {
        foreach ($choicesAndWeights as $stringAndWeight) {
            if (!is_array($stringAndWeight)) {
                $stringAndWeight = array($stringAndWeight, 1);
            }
            list($string, $weight) = $stringAndWeight;

            $this->addChoice($string, $weight);
        }

        return $this;
    }

    /**
     * @param $choice The string to add
     * @param int $weight The probabilistic weight of this string
     *
     * @return RandomProvider the current instance
     */
    public function addChoice($choice, $weight = 1)
    {
        $this->choices[] = array($choice, $weight);

        return $this;
    }

    /**
     * Return the array of strings withought the probabilistic weights
     *
     * @return array The array of choices without weights
     */
    public function getPlainChoices()
    {
       return array_map(function($item){
               return $item[0];
       }, $this->choices);
    }

    /**
     * The array of the weighted choices
     *
     * @return array
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param NumberGenerator $numberGenerator
     *
     * @return RandomProvider The current instance
     */
    public function setNumberGenerator(NumberGenerator $numberGenerator)
    {
        $this->numberGenerator = $numberGenerator;

        return $this;
    }

    /**
     * @return NumberGenerator
     */
    public function getNumberGenerator()
    {
        if (!isset($this->numberGenerator)) {
            $this->numberGenerator = new PhpNumberGenerator;
        }

        return $this->numberGenerator;
    }

}
