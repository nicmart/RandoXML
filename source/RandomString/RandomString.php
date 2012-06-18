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
     *
     * @return string
     */
    public function get()
    {
        return 'Ciao';
    }

}
