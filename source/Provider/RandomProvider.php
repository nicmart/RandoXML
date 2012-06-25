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
        $totalWeight = $this->getWeightsSum();
        $choices = $this->getChoices();
        $randMax = $this->getNumberGenerator()->randMax();

        $edge = 0;
        $n = $this->getNumberGenerator()->rand(0, $randMax);

        foreach ($choices as $choice) {
            $edge = round( ($choice[1] * ($randMax + 1)) / $totalWeight) + $edge;
            if($n < $edge)
                return $choice[0];
        }

        return $choices[count($choices) - 1][0];
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
            list($choice, $weight) = $stringAndWeight;

            $this->addChoice($choice, $weight);
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

    /**
     * Returns the sum of all choices weights
     *
     * @return int
     */
    private function getWeightsSum()
    {
        $sum = 0;

        foreach ($this->getChoices() as $choice) {
            $sum += $choice[1];
        }

        return $sum;
    }
}
