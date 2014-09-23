<?php

namespace BeeSlap\Domain\Bee\Model;

/**
 *
 * Bee interface   
 *
 * @author Fabrizio Manunta <fabrizio@karalisweblabs.com>
 */
interface Bee
{
    /**
     *
     * Reset points to initial value
     */
    public function resetPoints();

    /**
     *
     * Reduce available points 
     */
    public function hit();

    /**
     *
     * Kills the bee setting the available points to 0
     */
    public function kill();

    /**
     *
     * Checks if there's any points left
     *
     * @return bool
     */
    public function isDead();

    /**
     *
     * Returns an array rapresentation of the bee
     *
     * @return array
     */
    public function toArray();
}

?>

