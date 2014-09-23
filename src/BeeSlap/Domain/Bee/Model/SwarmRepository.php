<?php

namespace BeeSlap\Domain\Bee\Model;

/**
 *
 * Basic repository for Swarm model 
 *
 * @author Fabrizio Manunta <fabrizio@karalisweblabs.com>
 */
class SwarmRepository
{

    /**
     *
     * Stores swarm into session
     */
    public function save(Swarm $swarm)
    {
        $_SESSION['swarm'] = $swarm;
    }

    /**
     *
     * Gets swarm from session
     *
     * @return BeeSlap\Domain\Bee\Model\Swarm
     */
    public function get()
    {
        if(array_key_exists('swarm', $_SESSION)) {
            return $_SESSION['swarm'];
        }

    }

}

?>
