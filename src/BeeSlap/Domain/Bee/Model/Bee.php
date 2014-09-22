<?php

namespace BeeSlap\Domain\Bee\Model;

interface Bee
{
    public function resetPoints();
    public function hit();
    public function kill();
    public function isDead();
    public function toArray();
}

?>

