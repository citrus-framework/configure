<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2026, CitrusFramework. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Citrus\Configure;

/**
 * ドメイン設定の判定
 */
class DomainSetting
{
    /**
     * ドメイン設定されている設定配列かどうか
     * @param array $configures 設定値配列(全て)
     * @return bool true:ドメイン設定されている,false:されていない
     */
    public function exists(#[\SensitiveParameter] array $configures): bool
    {
        // 設定値配列に 'default' が有り、同階層の配列数が2以上の場合がドメイン設定されている
        return (array_key_exists('default', $configures) === true and count($configures) >= 2);
    }
}
