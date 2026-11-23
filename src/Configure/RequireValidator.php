<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2026, CitrusFramework. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Citrus\Configure;

/**
 * 必須設定値のチェック
 */
class RequireValidator
{
    /**
     * 必須チェック
     * 例外の文には設定の中身(パスワードなど)を入れない
     * @param array    $configures    設定値
     * @param string[] $require_keys  必須設定キー
     * @param string   $configure_key 設定ルートキー
     * @throws ConfigureException
     */
    public function validate(#[\SensitiveParameter] array $configures, array $require_keys, string $configure_key): void
    {
        foreach ($require_keys as $key)
        {
            ConfigureException::exceptionElse(
                array_key_exists($key, $configures),
                sprintf('設定ファイルの %s に %s の設定が存在しません', $configure_key, $key),
            );
        }
    }
}
