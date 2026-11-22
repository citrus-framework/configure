<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2019, CitrusFramework. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Test\Configure;

use Citrus\Configure\Configurable;
use Citrus\Configure\ConfigureException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * 設定値制御下用の抽象クラスのテスト
 */
class ConfigurableTest extends TestCase
{
    /**
     * @test
     */
    public function test_todo()
    {
        $this->assertTrue(true);
    }

    #[Test]
    public function 必須の設定が無いときの例外の文に設定の値が入らないこと(): void
    {
        $sut = new RequireSampleConfigure();

        try
        {
            $sut->loadConfigures(['test' => ['password' => 'SECRET_VALUE']]);
            $this->fail('例外が発生しませんでした');
        }
        catch (ConfigureException $e)
        {
            $this->assertSame('設定ファイルの test に secret の設定が存在しません', $e->getMessage());
            $this->assertStringNotContainsString('SECRET_VALUE', $e->getMessage());
        }
    }
}

/**
 * 必須設定ありのサンプルクラス
 */
class RequireSampleConfigure extends Configurable
{
    /**
     * 設定ルートキー
     * @return string
     */
    protected function configureKey(): string
    {
        return 'test';
    }

    /**
     * デフォルト設定値
     * @return array
     */
    protected function configureDefaults(): array
    {
        return [];
    }

    /**
     * 必須設定値
     * @return string[]
     */
    protected function configureRequires(): array
    {
        return ['secret'];
    }
}

/**
 * サンプルクラス
 */
class SampleConfigure extends Configurable
{
    /**
     * 設定ルートキー
     *
     * @return string
     */
    protected function configureKey(): string
    {
        return 'test';
    }



    /**
     * デフォルト設定値
     *
     * @return array [['設定キー' => '設定値', ...]]
     */
    protected function configureDefaults(): array
    {
        return [];
    }



    /**
     * 必須設定値
     *
     * @return string[]
     */
    protected function configureRequires(): array
    {
        return [];
    }
}
