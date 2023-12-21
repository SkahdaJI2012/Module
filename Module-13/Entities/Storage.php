<?php

namespace Entities;

abstract class Storage
{
    abstract public function create(TelegraphText $telegraphText);

    abstract public function read(string $slug): mixed;

    abstract public function update(string $slug, TelegraphText $telegraphText): void;

    abstract public function delete(string $slug): void;

    abstract public function list(): array;
}
