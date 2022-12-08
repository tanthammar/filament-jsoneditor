<?php

namespace InvadersXX\FilamentJsoneditor\Forms;

use Closure;
use Filament\Forms\Components\Field;

class JSONEditor extends Field
{
    public string $view = 'filament-jsoneditor::json-editor';

    protected int|Closure|null $height = 300;

    protected array|Closure|null $modes = ['code', 'form', 'text', 'tree', 'view', 'preview'];

    protected bool $jsonFormatted = false;

    public function modes(array|Closure|null $modes): static
    {
        $this->modes = $modes;

        return $this;
    }

    public function height(int|Closure|null $height): static
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Is the model field casted to 'json'?
     */
    public function isJson(bool $state = true): static
    {
        $this->jsonFormatted = $state;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->evaluate($this->height);
    }

    public function getModes(): ?string
    {
        return json_encode($this->evaluate($this->modes));
    }

    public function getJsonFormatted(): bool
    {
        return $this->jsonFormatted;
    }
}
