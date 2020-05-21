<?php
namespace App\Tests\Domain\Manager;

use App\Domain\Manager\RatingManager;
use PHPUnit\Framework\TestCase;

/**
 * Тест для класса {@see RatingManager}
 */
class RatingManagerTest extends TestCase
{
    private string $endpointAddress  = "http://127.0.0.1:8000/endpoint";

    /**
     * Тест для {@see RatingManager::getRatingByAddress()}
     */
    public function testGetRatingByAddress()
    {
        $ratingManager = new RatingManager();
        $data = $ratingManager->getRatingByAddress($this->endpointAddress);

        $expected = [
            ['rank' => 1, 'team' => 'Eva', 'scores'    => 99],
            ['rank' => 1, 'team' => 'WALL-E', 'scores' => 99],
            ['rank' => 3, 'team' => 'Axiom', 'scores'  => 88],
            ['rank' => 4, 'team' => 'BnL', 'scores'    => 65],
        ];

        $this->assertEquals($expected, $data->toArray());
    }
}