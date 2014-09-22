<?php

namespace BeeSlap\Application\Service;
use BeeSlap\Application\Dto\Swarm;
use BeeSlap\Domain\Bee\Service\Swarm as SwarmDomainService;
use BeeSlap\Domain\Bee\Model\SwarmRepository;
use BeeSlap\Domain\Bee\Model\Swarm as SwarmModel;

class Game 
{
    
    protected $_swarmService;

    protected $_swarmRepository;

    public function __construct()
    {
        session_start();
        $this->_swarmService = new SwarmDomainService();
        $this->_swarmRepository = new SwarmRepository();
    }

    public function newGame()
    {
        $newSwarm = $this->_swarmService->build();
        $this->_swarmRepository->save($newSwarm);
        return new Swarm($newSwarm->toArray());

    }

    public function getGameInProgress()
    {
        $swarm = $this->_swarmRepository->get();
        if($swarm instanceof SwarmModel) {
            return new Swarm($swarm->toArray());
        }
    }

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
