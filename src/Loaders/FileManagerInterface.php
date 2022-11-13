<?php

namespace Cyntelli\DataLoader\Loaders;

/**
 * This is a FileManagerInterface, all file manager classes must implmenting this interface
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
interface FileManagerInterface
{
    /**
     * genearte
     *
     * @return string
     */
    public function generate(): string;

    /**
     * get destinations
     *
     * @return String[]
     */
    public function getDestinations(): array;
}