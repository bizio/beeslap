<?php

namespace BeeSlap\Domain\Bee\Model;
use BeeSlap\Domain\Bee\Model\Queen;
use BeeSlap\Domain\Bee\Model\Worker;
use BeeSlap\Domain\Bee\Model\Drone;

class Swarm extends \ArrayObject
{
    const TYPE_QUEEN  = 'Queen';
    const TYPE_WORKER = 'Worker';
    const TYPE_DRONE  = 'Drone';

    protected $_queenBees;

    protected $_workerBees;

    protected $_droneBees;

    public function addBee(Bee $bee)
    {
        switch (true) {
            case $bee instanceof Queen:
                $this->_queenBees[] = $bee;
                break;
            case $bee instanceof Worker:
                $this->_workerBees[] = $bee;
                break;
            case $bee instanceof Drone:
                $this->_droneBees[] = $bee;
                break;
            default:
                throw new \Exception('Invalid bee type');
        }

        $this->append($bee);

    }

    public function pickRandomBee()
    {
        $bee = $this[rand(0, count($this) - 1)];
        if($bee->isDead()) {
            return $this->pickRandomBee();
        }

        return $bee;
    }

    public function queensCount()
    {
        return $this->_count($this->_queenBees);
    }

    public function workersCount()
    {
        return $this->_count($this->_workerBees);
    }

    public function dronesCount()
    {
        return $this->_count($this->_droneBees);
    }

    public function count()
    {
        return $this->queensCount() + $this->workersCount() + $this->dronesCount();
    }

    public function toArray()
    {
        $bees = array();
        foreach($this as $bee) {
            $bees[] = $bee->toArray();
        }

        return $bees;
    }

    public function getAllByType($type)
    {
        switch($type) {
            case self::TYPE_QUEEN:
                return $this->_queenBees;
            case self::TYPE_WORKER:
                return $this->_workerBees;
            case self::TYPE_DRONE:
                return $this->_droneBees;
            default:
                throw new \Exception('Invalid type');
        } 
    }

    protected function _count(array $bees)
    {
        $livingBees = array_filter($bees, function(Bee $bee) { 
            return !$bee->isDead(); 
        });

        return count($livingBees);
    }

}

?>
