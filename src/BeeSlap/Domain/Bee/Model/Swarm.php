<?php

namespace BeeSlap\Domain\Bee\Model;
use BeeSlap\Domain\Bee\Model\Queen;
use BeeSlap\Domain\Bee\Model\Worker;
use BeeSlap\Domain\Bee\Model\Drone;

/**
 *
 * Bees collection
 *
 * @author Fabrizio Manunta <fabrizio@karalisweblabs.com>
 */
class Swarm extends \ArrayObject
{
    const TYPE_QUEEN  = 'Queen';
    const TYPE_WORKER = 'Worker';
    const TYPE_DRONE  = 'Drone';

    /**
     *
     * @var array, collectiion of BeeSlap\Domain\Bee\Model\Queen
     */
    protected $_queenBees;

    /**
     *
     * @var array, collectiion of BeeSlap\Domain\Bee\Model\Worker
     */
    protected $_workerBees;

    /**
     *
     * @var array, collectiion of BeeSlap\Domain\Bee\Model\Drone
     */
    protected $_droneBees;

    /**
     *
     * Adds a bee to the collection
     *
     * @param BeeSlap\Domain\Bee\Model\Bee
     */
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

    /**
     *
     * Randomly selects a bee from the collection
     *
     * @return BeeSlap\Domain\Bee\Model\Bee
     */
    public function pickRandomBee()
    {
        $bee = $this[rand(0, count($this) - 1)];
        if($bee->isDead()) {
            return $this->pickRandomBee();
        }

        return $bee;
    }

    /**
     *
     * Returns number of queen bees alive
     *
     * @return int
     */
    public function queensCount()
    {
        return $this->_count($this->_queenBees);
    }

    /**
     *
     * Returns number of worker bees alive
     *
     * @return int
     */
    public function workersCount()
    {
        return $this->_count($this->_workerBees);
    }

    /**
     *
     * Returns number of drone bees alive
     *
     * @return int
     */
    public function dronesCount()
    {
        return $this->_count($this->_droneBees);
    }

    /**
     *
     * Total number of bees alive
     * 
     * @return int
     */
    public function count()
    {
        return $this->queensCount() + $this->workersCount() + $this->dronesCount();
    }

    /**
     *
     * Returns array rapresentation of the collection
     *
     * @return array
     */
    public function toArray()
    {
        $bees = array();
        foreach($this as $bee) {
            $bees[] = $bee->toArray();
        }

        return $bees;
    }

    /**
     *
     * Get all bees of a given type
     *
     * @return array
     */
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

    /**
     *
     * Filter out alive bees from a given collection and returns count
     *
     * @return int
     */
    protected function _count(array $bees)
    {
        $livingBees = array_filter($bees, function(Bee $bee) { 
            return !$bee->isDead(); 
        });

        return count($livingBees);
    }

}

?>
