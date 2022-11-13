<?php

namespace Cyntelli\DataLoader\Loaders;

/**
 * This is a file manager class for generating destinations
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class FileManager implements FileManagerInterface
{
    /**
     * @var string[] $dests
     */
    private $dests = [];

    /**
     * @var string $format
     */
    private $format;

    /**
     * construct
     *
     * @param string $destPath
     * @param string $extension
     * @param string $prefix defaut: file_
     * @param int $sequenceLength default: 3
     */
    public function __construct(private string $destPath, private $extension, private string $prefix = 'file_', int $sequenceLength = 3)
    {
        if (!is_dir($this->destPath))
            mkdir($destPath, 0755, true);

        $this->format = '%s/%s%0' . $sequenceLength . 'd.%s';
    }

    /**
     * genearte
     *
     * @return string
     */
    public function generate(): string
    {
        $seq = count($this->dests) + 1;
        $dest = sprintf($this->format, $this->destPath, $this->prefix, $seq, $this->extension);
        $this->dests[] = $dest;
        return $dest;
    }

    /**
     * get destinations
     *
     * @return string[]
     */
    public function getDestinations(): array
    {
        return $this->dests;
    }
}