<?php

namespace App\Service;

use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    /**
     * @var SluggerInterface
     */
    private $slugger;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param Filesystem $articlesFilesystem
     * @param SluggerInterface $slugger
     */
    public function __construct(Filesystem $articlesFilesystem, SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
        $this->filesystem = $articlesFilesystem;
    }

    /**
     * @param File $file
     * @param string|null $oldFileName
     * @return string
     */
    public function uploadFile(File $file, ?string $oldFileName = null): string
    {
        $fileName = $this->slugger
            ->slug(pathinfo($file instanceof UploadedFile ? $file->getClientOriginalName() : $file->getFilename(), PATHINFO_FILENAME))
            ->append('-' . uniqid())
            ->append('.' . $file->guessExtension())
            ->toString()
        ;

        $stream = fopen($file->getPathname(), 'r');
        $this->filesystem->writeStream($fileName, $stream);
        if (is_resource($stream)) {
            fclose($stream);
        }

        if ($oldFileName && $this->filesystem->has($oldFileName)) {
            $this->filesystem->delete($oldFileName);
        }

        return $fileName;
    }
}