<?php

namespace Dicibi\IndoRegion\Tests\Unit;

use Dicibi\IndoRegion\RawDataGetter as RawData;
use PHPUnit\Framework\TestCase;

/**
 * Data Test
 */
class RawDataTest extends TestCase
{
    /**
     * @throws \League\Csv\Exception
     */
    public function testCanResolveProvinces(): void
    {
        $data = [...RawData::getProvinces()];

        $this->assertNotEmpty($data);
    }

    /**
     * @throws \League\Csv\Exception
     */
    public function testCanResolveRegencies(): void
    {
        $data = [...RawData::getRegencies()];

        $this->assertNotEmpty($data);
    }

    /**
     * @throws \League\Csv\Exception
     */
    public function testCanResolveDistricts(): void
    {
        $data = [...RawData::getDistricts()];

        $this->assertNotEmpty($data);
    }

    /**
     * @throws \League\Csv\Exception
     */
    public function testCanResolveVillages(): void
    {
        $data = [...RawData::getVillages()];

        $this->assertNotEmpty($data);
    }
}
