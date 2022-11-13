<?php

namespace Cyntelli\DataLoader\Loaders;

/**
 * This is a LoaderInterface, all loader classes must implmenting this interface
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
interface LoaderInterface
{
    /**
     * push
     *
     * @param mixed[] $values
     * @param bool $isAssoc default: true
     * @return void
     */
    public function push(array $values, bool $isAssoc = true): void;

    /**
     * output current data and generate destination automatically, must set fileManager before using this method
     *
     * @return Result
     */
    public function load(): Result;

    /**
     * output current data into specific destination
     *
     * @param string $dest
     * @return Result
     */
    public function output(string $dest): Result;

    /**
     * can load by length
     *
     * @param int $length bytes
     * @return bool
     */
    public function canLoadByLength(int $length): bool;

    /**
     * can load by rows
     *
     * @param int $rows
     * @return bool
     */
    public function canLoadByRows(int $rows): bool;

    /**
     * get data
     *
     * @return array<mixed[]>
     */
    public function getData(): array;
}