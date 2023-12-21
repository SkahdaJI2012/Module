<?php

namespace Entities;

use Interfaces\IRender;

class Swig extends View
{
    public function render(TelegraphText $telegraphText): string
    {
        $contentFile = sprintf(('Core/templates/%s.swig'), $this->templateNameProt);
        $swig = '';
        if (file_exists($contentFile)) {
            $swig = file_get_contents($contentFile);
            foreach ($this->variablesArrayProt as $key) {
                $getKey = 'get' . ucfirst($key);
                $swig = str_replace('{{' . $key . '}}', $telegraphText->$getKey(), $swig);
            }
        }
        return $swig;
    }
}
