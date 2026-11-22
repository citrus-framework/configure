<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2026, CitrusFramework. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Citrus\Configure;

/**
 * ドメインコードの決定
 */
class DomainCode
{
    /**
     * ドメインコードの取得
     * @return string ドメインコード
     * @throws ConfigureException
     */
    public function resolve(): string
    {
        // httpアクセスの場合
        if (isset($_SERVER['HTTP_HOST']) === true)
        {
            return $_SERVER['HTTP_HOST'];
        }

        // コマンドラインアクセスの場合
        $options = getopt('', [
            'domain::',
        ]);
        if (isset($options['domain']) === true)
        {
            return $options['domain'];
        }

        // デバッグ
        if (defined('UNIT_TEST') === true and UNIT_TEST === true)
        {
            return 'example.com';
        }

        throw new ConfigureException('設定ファイルのドメイン設定が不明です');
    }
}
