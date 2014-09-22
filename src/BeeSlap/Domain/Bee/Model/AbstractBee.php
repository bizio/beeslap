<?php

namespace BeeSlap\Domain\Bee\Model;

abstract class AbstractBee
{
    const HIT_DAMAGE = 1;
    const STARTING_POINTS = 1;
    protected $_totalPoints;
    protected $_remainingPoints;

    public function __construct($points = 0)
    {
        $points = (int) $points;
        if($points <= 0) {
            $points = static::STARTING_POINTS;
        }

        $this->_totalPoints = $this->_remainingPoints = $points;
    }

    public function resetPoints()
    {
        $this->_remainingPoints = $this->_totalPoints;
    }

    public function hit()
    {
        if($this->isDead()) {
            throw new \Exception('Cannot hit a dead bee');
        }

        $this->_remainingPoints -= static::HIT_DAMAGE;
    }

    public function kill()
    {
        $this->_remainingPoints = 0;
    }

    public function isDead()
    {
        return (bool) ($this->_remainingPoints <= 0);
    }

    public function toArray()
    {
        $type = str_replace(array(__NAMESPACE__, '\\'), '', get_called_class());
        return array('type' => $type, 'points' => $this->_remainingPoints);
    }

}

?>
