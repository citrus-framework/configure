<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2019, CitrusFramework. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Citrus;

/**
 * 設定値保持管理クラス
 */
class Configure
{
    /**
     * 全体設定の設定値保持
     * 個別の設定はConfigurableを継承することで保持
     * @var array [['設定キー' => '設定値', ...]]
     */
    private static array $CONFIGURES = [];

    /**
     * 配列から設定
     * @param array $configures 設定配列
     */
    public static function setUpFromArray(array $configures): void
    {
        self::$CONFIGURES = $configures;
    }

    /**
     * パスから読み込んで設定
     * @param string $path_configure 設定のパス
     */
    public static function setUpFromPath(string $path_configure): void
    {
        self::setUpFromArray(include($path_configure));
    }

    /**
     * 全体設定の取得
     * @return array
     */
    public static function callConfigures(): array
    {
        return self::$CONFIGURES;
    }
}
