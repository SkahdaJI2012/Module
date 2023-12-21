<?php

namespace Entities;

use Interfaces\IRender;

class Spl extends View
{
    public function render(TelegraphText $telegraphText): string
    {
        $contentFile = sprintf(('Core/templates/%s.spl'), $this->templateNameProt);
        $spl = '';
        if (file_exists($contentFile)) {
            $spl = file_get_contents($contentFile);
            foreach ($this->variablesArrayProt as $key) {
                $getKey = 'get' . ucfirst($key);
                $spl = str_replace('$$' . $key . '$$', $telegraphText->$getKey(), $spl);
            }
        }
        return $spl;
    }
}
