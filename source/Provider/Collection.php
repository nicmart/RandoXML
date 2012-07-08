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
     * The array ov cached values returned by providers
     *
     * @var array
     */
    private $cachedValues = array();

    /**
     *
     * @return mixed
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @param string $name
     * @param Provider $provider
     * @param boolean $cached
     *
     * @return Collection The current instance
     */
    public function register($name, Provider $provider, $cached = true)
    {
        $this->providers[$name] = array($provider, $cached);

        return $this;
    }

    /**
     * @param string $name
     * @return Provider
     * @throws \InvalidArgumentException
     */
    public function provider($name)
    {
        if (!isset($this->providers[$name])) {
            throw new \InvalidArgumentException("There is no provider registered with name '$name'");
        }

        return $this->providers[$name][0];
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function value($name)
    {
        if (!isset($this->cachedValues[$name]) || !$this->isProviderCached($name)) {
            $this->cachedValues[$name] = $this->provider($name)->get();
        }

        return $this->cachedValues[$name];
    }

    /**
     * Is the provider cached?
     *
     * @param $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    private function isProviderCached($name)
    {
        if (!isset($this->providers[$name])) {
            throw new \InvalidArgumentException("There is no provider registered with name '$name'");
        }

        return $this->providers[$name][1];
    }
}
