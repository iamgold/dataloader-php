<?php

namespace Cyntelli\DataLoader\Loaders;

/**
 * It's a class of result that output by loader
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class Result
{
    /**
     * construct
     *
     * @param int $length
     * @param int $rows
     * @param string $path
     */
    public function __construct(private int $length, private int $rows, private string $path)
    {}

    /**
     * get length
     *
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * get rows
     *
     * @return int
     */
    public function getRows(): int
    {
        return $this->rows;
    }

    /**
     * get path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}