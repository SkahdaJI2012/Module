<?php

namespace Entities;

class TelegraphText
{
    private string $title;
    private string $text;
    private string $author;
    private string $published;
    private string $slug;

    public function __construct(string $author, string $slug)
    {
        $this->author = $author;
        $this->slug = $slug;
        $this->published = date('d-m-y');
    }

    private function storeText(): void
    {
        $arrayText = [
            'title' => $this->title,
            'text' => $this->text,
            'author' => $this->author,
            'published' => $this->published,
        ];
        $serialize = serialize($arrayText);
    }

    private function loadText(): mixed
    {
        if (file_exists($this->slug)) {
            return unserialize(file_get_contents($this->slug));;
        }
    }

    public function editText(string $title, string $text): void
    {
        $this->title = $title;
        $this->text = $text;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setAuthor(string $author): void
    {
        if (strlen($author) < 120) {
            $this->author = $author;
        }
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setSlug(string $slug): void
    {
        $formSlug = preg_match('/^[\w]+$/', $slug);
        if ($formSlug === 1) {
            $this->slug = $slug;
        }
    }
    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setPublished(string $published): void
    {
        if ($published >= date('d-m-y')) {
            $this->published = $published;
        }
    }

    public function getPublished(): string
    {
        return $this->published;
    }

    public function __get(string $name): string
    {
        switch ($name) {
            case 'author':
                return $this->getAuthor();
                break;
            case 'slug':
                return $this->getSlug();
                break;
            case 'published':
                return $this->getPublished();
                break;
        }
    }

    public function __set(string $name, string $value): void
    {
        switch ($name) {
            case 'author':
                $this->setAuthor($value);
                break;
            case 'slug':
                $this->setSlug($value);
                break;
            case 'published':
                $this->setPublished($value);
                break;
        }
    }
}
