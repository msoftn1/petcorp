<?php

namespace App\Domain\DTO;

/**
 * DTO рейтинга.
 */
class Rating
{
    /** Рэйтинг. */
    private int $rank;

    /** Команда. */
    private string $team;

    /** Очки. */
    private int $scores;

    /**
     * Конструктор.
     *
     * @param int    $rank
     * @param string $team
     * @param int    $scores
     */
    public function __construct(int $rank, string $team, int $scores)
    {
        $this->rank   = $rank;
        $this->team   = $team;
        $this->scores = $scores;
    }

    /**
     * Преобразовать DTO в массив.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'rank'   => $this->rank,
            'team'   => $this->team,
            'scores' => $this->scores
        ];
    }
}
