<?php

namespace BeeSlap\Application\Service;
use BeeSlap\Application\Dto\Swarm;
use BeeSlap\Domain\Bee\Service\Swarm as SwarmDomainService;
use BeeSlap\Domain\Bee\Model\SwarmRepository;
use BeeSlap\Domain\Bee\Model\Swarm as SwarmModel;

/**
 *
 * Game service 
 *
 * @author Fabrizio Manunta <fabrizio@karalisweblabs.com>
 */
class Game 
{
    
    /**
     *
     * @var BeeSlap\Domain\Bee\Service\Swarm $_swarmService
     */
    protected $_swarmService;

    /**
     *
     * @var BeeSlap\Domain\Bee\Model\SwarmRepository $_swarmRepository
     */
    protected $_swarmRepository;

    /**
     *
     * Initialize the game
     */
    public function __construct()
    {
        session_start();
        $this->_swarmService = new SwarmDomainService();
        $this->_swarmRepository = new SwarmRepository();
    }

    /**
     * 
     * Start a new game
     *
     * @return BeeSlap\Application\Dto\Swarm
     */
    public function newGame()
    {
        $newSwarm = $this->_swarmService->build();
        $this->_swarmRepository->save($newSwarm);
        return new Swarm($newSwarm->toArray());

    }

    /**
     *
     * Get current game progress
     *
     * @return BeeSlap\Application\Dto\Swarm
     */
    public function getGameInProgress()
    {
        $swarm = $this->_swarmRepository->get();
        if($swarm instanceof SwarmModel) {
            return new Swarm($swarm->toArray());
        }
    }

    /**
     *
     * Hit a random bee 
     *
     * @return BeeSlap\Application\Dto\Swarm
     * @throws \Exception
     */
    public function randomSlap()
    {
        $swarm = $this->_swarmRepository->get();
        if(!$swarm instanceof SwarmModel) {
            throw new \Exception('Game not started');
        }

        if(true === $this->_swarmService->hit($swarm)) {
            $this->_swarmRepository->save($swarm);
            return new Swarm($swarm->toArray());
        }

        throw new \Exception('All bees are dead');

    }

    /**
     *
     * Kill all queen bees
     *
     * @throws \Exception
     */
    public function killAllQueens()
    {
        $swarm = $this->_swarmRepository->get();
        if(!$swarm instanceof SwarmModel) {
            throw new \Exception('Game not started');
        }

        $this->_swarmService->killAllQueens($swarm);
    }
}

?>
