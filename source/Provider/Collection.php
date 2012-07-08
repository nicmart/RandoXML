<?php
namespace nicmart\Random\Provider;

/**
 * A named collection of providers
 */
class Collection implements Provider
{
    /**
     * The array of providers
     *
     * @var array
     */
    private $providers = array();

    /**
     *
     * @return mixed
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @param $name
     * @param Provider $provider
     *
     * @return Collection The current instance
     */
    public function register($name, Provider $provider)
    {
        $this->providers[$name] = $provider;

        return $this;
    }

    /**
     * @param $name
     * @return Provider
     * @throws \InvalidArgumentException
     */
    public function provider($name)
    {
        if (!isset($this->providers[$name])) {
            throw new \InvalidArgumentException("There is no provider registered with name '$name'");
        }

        return $this->providers[$name];
    }

}
