<?php

namespace BeeSlap\Domain\Bee\Service;
use BeeSlap\Domain\Bee\Model\Swarm as SwarmModel;
use BeeSlap\Domain\Bee\Model\Queen;
use BeeSlap\Domain\Bee\Model\Worker;
use BeeSlap\Domain\Bee\Model\Drone;

/**
 *
 * Swarm service, contains all the business logic for the game
 *
 * @author Fabrizio Manunta <fabrizio@karalisweblabs.com>
 */
class Swarm
{
    /**
     * @TODO we could change these into variables so we can
     * pass them in as configuration parameters
     */
    const MAX_NUMBER_OF_BEES = 15;
    const MAX_NUMBER_OF_QUEEN_BEES = 3;
    const MAX_NUMBER_OF_WORKER_BEES = 5;
    const MAX_NUMBER_OF_DRONE_BEES = 7;

    /**
     *
     * Builds a new swarm
     *
     * @return BeeSlap\Domain\Bee\Model\Swarm
     */
    public function build()
    {
        $swarm = new SwarmModel();
        for ($i = 0; $i < self::MAX_NUMBER_OF_BEES; $i++) {
            
            switch(true) {
                case $i < 3:
                    $swarm->addBee(new Queen());
                    break;
                case $i >= 3 && $i < 8:
                    $swarm->addBee(new Worker());
                    break;
                case $i >= 8:
                    $swarm->addBee(new Drone());
                    break;

            }

        }

        return $swarm;

    }

    /**
     *
     * Hits a random bee from a given swarm
     *
     * @return bool
     */
    public function hit(SwarmModel $swarm)
    {
        // if all the queen bees are dead the game is over
        if($swarm->queensCount() <= 0) {
            return false;
        }

        $randomBee = $swarm->pickRandomBee();
        $randomBee->hit();

        return true;

    }

    /**
     *
     * Kills all queen bees
     *
     */
    public function killAllQueens(SwarmModel $swarm)
    {
        foreach($swarm->getAllByType(SwarmModel::TYPE_QUEEN) as $queens) {
            $queens->kill();
        } 

    }
    
}

?>
