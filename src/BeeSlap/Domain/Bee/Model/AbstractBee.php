<?php

namespace BeeSlap\Domain\Bee\Model;

/**
 *
 * AbstractBee defines core methods for a bee   
 *
 * @author Fabrizio Manunta <fabrizio@karalisweblabs.com>
 */
abstract class AbstractBee
{
    const HIT_DAMAGE = 1;
    const STARTING_POINTS = 1;

    /**
     *
     * Total points available
     *
     * @var int $_totalPoints
     */
    protected $_totalPoints;
    
    /**
     * 
     * Points left after each hit
     *
     * @var int $_remainingPoints
     */
    protected $_remainingPoints;

    /**
     *
     * Initialize the bee with total points available
     *
     * @var int $points
     */
    public function __construct($points = 0)
    {
        $points = (int) $points;
        if($points <= 0) {
            $points = static::STARTING_POINTS;
        }

        $this->_totalPoints = $this->_remainingPoints = $points;
    }

    /**
     *
     * Reset points to initial value
     */
    public function resetPoints()
    {
        $this->_remainingPoints = $this->_totalPoints;
    }

    /**
     *
     * Reduce available points by the defined HIT_DAMAGE constant
     */
    public function hit()
    {
        if($this->isDead()) {
            throw new \Exception('Cannot hit a dead bee');
        }

        $this->_remainingPoints -= static::HIT_DAMAGE;
    }

    /**
     *
     * Kills the bee setting the available points to 0
     */
    public function kill()
    {
        $this->_remainingPoints = 0;
    }

    /**
     *
     * Checks if there's any points left
     *
     * @return bool
     */
    public function isDead()
    {
        return (bool) ($this->_remainingPoints <= 0);
    }

    /**
     *
     * Returns an array rapresentation of the bee
     *
     * @return array
     */
    public function toArray()
    {
        $type = str_replace(array(__NAMESPACE__, '\\'), '', get_called_class());
        return array('type' => $type, 'points' => $this->_remainingPoints);
    }

}

?>
