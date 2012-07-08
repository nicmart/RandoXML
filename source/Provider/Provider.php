<?php
namespace nicmart\Random\Provider;

/**
 * Interface to retrieve a random Object
 */
interface Provider
{
    /**
     * @abstract
     *
     * @return mixed
     */
    public function get();
}