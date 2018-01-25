<?php
declare(strict_types=1);

namespace App\Tests\Storage;

use Makasim\Yadm\Storage;
use Payum\Core\Storage\StorageInterface;
use App\Storage\YadmStorage;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class YadmStorageTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testShouldImplementsStorageInterface()
    {
        $rc = new ReflectionClass(YadmStorage::class);

        $this->assertTrue($rc->implementsInterface(StorageInterface::class));
    }

    public function testCouldBeConstructedWithYadmStorageAsFirstArgument() : YadmStorage
    {
        $storageMock = $this->createMock(Storage::class);

        new YadmStorage($storageMock);
    }
}