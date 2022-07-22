<?php

namespace App\Model;

final class Report
{
    /**
     * @var array
     */
    private array $teams;

    /**
     * @return array
     */
    public function getTeams(): array
    {
        return $this->teams;
    }

    /**
     * @param array $teams
     */
    public function setTeams(array $teams): void
    {
        $this->teams = $teams;
    }
}
