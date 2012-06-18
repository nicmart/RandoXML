<?php
namespace nicmart\Random\String;

/**
 * Interface to retrieve a random string
 */
interface RandomStringInterface
{
    /**
     * @abstract
     *
     * @return string
     */
    public function get();
}