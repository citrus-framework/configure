<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2026, CitrusFramework. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Citrus\Configure;

/**
 * 設定値配列から使う部分を選ぶ
 */
class ConfigureSelector
{
    /**
     * デフォルト設定とドメイン設定の選択
     * @param array      $configures 設定値配列(全て)
     * @param string     $key        設定ルートキー
     * @param DomainCode $domain     ドメインコードの決定
     * @return array [デフォルト設定, ドメイン設定]
     * @throws ConfigureException
     */
    public function select(array $configures, string $key, DomainCode $domain): array
    {
        // ドメイン設定されていない
        if ((new DomainSetting())->exists($configures) === false)
        {
            /**
             * ドメイン設定されていなくてもdefault設定はされている場合がある
             * 1. 'default' => [ 'key' => {configures} ]
             * 2. 'key' => {configures}
             * 3. {configures}
             */
            return [
                ($configures['default'][$key] ?? $configures[$key] ?? $configures),
                [],
            ];
        }

        // ドメイン設定されている
        return [
            ($configures['default'][$key] ?? []),
            ($configures[$domain->resolve()][$key] ?? []),
        ];
    }
}
