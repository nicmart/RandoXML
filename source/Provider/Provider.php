<?php
namespace nicmart\Random\Provider;

/**
 * Interface to retrieve a random string
 */
interface Provider
{
    /**
     * @abstract
     *
     * @return string
     */
    public function get();
}