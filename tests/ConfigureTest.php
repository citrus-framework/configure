<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2019, CitrusFramework. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Test;

use Citrus\Configure;
use PHPUnit\Framework\TestCase;

/**
 *設定値保持管理クラスのテスト
 */
class ConfigureTest extends TestCase
{
    /**
     * @test
     */
    public function setUpFromArray_and_callConfigures_想定通り()
    {
        $configures = ['test' => 'test'];
        Configure::setUpFromArray($configures);
        // 検算
        $this->assertSame($configures, Configure::callConfigures());
    }
}
