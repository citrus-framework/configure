<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2019, CitrusFramework. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Citrus\Configure;

use Citrus\Collection;

/**
 * 設定値制御下用の抽象クラス
 */
abstract class Configurable
{
    /** @var array 設定値保持 [['設定キー' => '設定値', ...]] */
    public array $configures = [];

    /**
     * 設定値配列の読み込み
     * @param array $configures 設定値配列(全て)
     * @return static
     * @throws ConfigureException
     */
    public function loadConfigures(array $configures = []): self
    {
        // デフォルト設定とドメイン設定の選択
        [$defaults, $domains] = (new ConfigureSelector())->select($configures, $this->configureKey(), new DomainCode());

        // デフォルトに、ドメイン設定、デフォルト設定をマージする
        $this->configures = Collection::stream($this->configureDefaults())
            ->betterMerge($defaults)
            ->betterMerge($domains)
            ->toList();

        // 設定値チェック(継承先が必須設定キーの取得で設定値を補うこともあるので、先に取得する)
        $require_keys = $this->configureRequires();
        (new RequireValidator())->validate($this->configures, $require_keys, $this->configureKey());

        return $this;
    }

    /**
     * 設定ルートキー
     * @return string
     */
    protected function configureKey(): string
    {
        return static::class;
    }

    /**
     * デフォルト設定値
     * @return array [['設定キー' => '設定値', ...]]
     */
    abstract protected function configureDefaults(): array;

    /**
     * 必須設定値
     * @return string[]
     */
    abstract protected function configureRequires(): array;
}
