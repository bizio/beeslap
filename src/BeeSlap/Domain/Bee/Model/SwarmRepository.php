<?php

namespace BeeSlap\Domain\Bee\Model;

class SwarmRepository
{

    public function save(Swarm $swarm)
    {
        $_SESSION['swarm'] = $swarm;
    }

    public function get()
    {
        if(array_key_exists('swarm', $_SESSION)) {
            return $_SESSION['swarm'];
        }

    }

}

?>
