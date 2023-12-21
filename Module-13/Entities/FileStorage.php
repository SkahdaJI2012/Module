<?php

namespace Entities;

use Entities\TelegraphText;

class FileStorage extends Storage
{
    public function create(TelegraphText $telegraphText): string
    {
        $index = 0;
        do {
            $filename = sprintf('%s_%s_%s', $telegraphText->slug, date('m.d.Y'), $index);
            if ($index === 0) {
                $filename = sprintf('%s_%s', $telegraphText->slug, date('m.d.Y'));
            }

            if (file_exists($filename)) {
                $index++;
                continue;
            }

            $telegraphText->slug = $filename;

            file_put_contents($filename, serialize($telegraphText));

            break;
        } while (true);

        return $telegraphText->slug;
    }

    public function read(string $slug): ?TelegraphText
    {
        if (file_exists($slug)) {
            return unserialize(file_get_contents($slug));
        }

        return null;
    }

    public function update(string $slug, TelegraphText $telegraphText): void
    {
        if (file_exists($slug)) {
            file_put_contents($slug, serialize($telegraphText));
        }
    }

    public function delete(string $slug): void
    {
        if (file_exists($slug)) {
            unlink($slug);
        }
    }

    public function list(): array
    {
        $arrayFile = [];
        $dir = getcwd();
        $scamDir = scandir($dir);

        foreach ($scamDir as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            if (is_dir($item)) {
                continue;
            }
            if (unserialize($item) !== false) {
                continue;
            } else {
                $readFile = file_get_contents($item);
                $uns = unserialize($readFile);
                array_push($arrayFile, $uns);
            }
        }
        return $arrayFile;
    }
}
