<?php
namespace nicmart\Random\String;

/**
 * This class picks randomly a string from a fixed collection of strings
 */
class RandomString implements RandomStringInterface
{
    /**
     * @var array
     */
    private $strings;

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
     * @return RandomString the current instance
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

}
