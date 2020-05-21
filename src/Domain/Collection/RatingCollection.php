<?php

namespace App\Domain\Collection;

use App\Domain\DTO\Rating;

/**
 * Класс коллекций рэйтинга.
 */
class RatingCollection
{
    /** @var Rating[] объекты рэйтинга  */
    private array $ratingList = [];

    /**
     * Добавить рэйтинг в коллекцию.
     *
     * @param Rating $rating
     */
    public function addRating(Rating $rating): void
    {
        $this->ratingList[] = $rating;
    }

    /**
     * Преобразовать коллекцию в массив.
     *
     * @return array
     */
    public function toArray(): array
    {
        return \array_map(
            fn(Rating $rating) => $rating->toArray(),
            $this->ratingList
        );
    }
}
