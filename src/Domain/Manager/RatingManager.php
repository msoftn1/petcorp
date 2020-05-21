<?php

namespace App\Domain\Manager;

use App\Domain\Collection\RatingCollection;
use App\Domain\DTO\Rating;
use App\Domain\Exception\RatingException;

/**
 * Менеджер рейтинга.
 */
class RatingManager
{
    /**
     * Получить рейтинг из URL адреса.
     *
     * @param string $address
     *
     * @return RatingCollection
     * @throws RatingException
     */
    public function getRatingByAddress(string $address): RatingCollection
    {
        try {
            $data = $this->loadData($address);
            $this->sortData($data);

            return $this->getRating($data);
        }
        catch (\Throwable $e) {
                throw new RatingException("Ошибка в процессе получения рейтинга.");
        }
    }

    /**
     * Загрузить данные.
     *
     * @param string $address
     *
     * @return array
     */
    private function loadData(string $address): array
    {
        $rawData = file_get_contents($address);

        return \json_decode($rawData, true);
    }

    /**
     * Сортировать данные.
     *
     * @param $data
     */
    private function sortData(&$data)
    {
        usort($data, static function ($a, $b) {
            if ($a['scores'] == $b['scores']) {
                return 0;
            }

            return ($a['scores'] < $b['scores']) ? 1 : -1;
        });
    }

    /**
     * Метод получения рейтинга из данных.
     *
     * @param array $data
     *
     * @return RatingCollection
     */
    private function getRating(array $data): RatingCollection
    {
        $scores2count = [];
        foreach ($data as $item) {
            if (!\array_key_exists($item['scores'], $scores2count)) {
                $scores2count[$item['scores']] = 0;
            }

            $scores2count[$item['scores']]++;
        }

        $ret = new RatingCollection();

        $ratingNumber = 1;
        $sharedRating = false;
        foreach ($data as $item) {
            $ratingDto = new Rating($ratingNumber, $item['team'], $item['scores']);

            $ret->addRating($ratingDto);

            $scores2count[$item['scores']]--;

            if ($scores2count[$item['scores']] == 0) {
                $ratingNumber++;

                if ($sharedRating) {
                    $ratingNumber++;
                    $sharedRating = false;
                }
            } else {
                $sharedRating = true;
            }

        }

        return $ret;
    }
}
