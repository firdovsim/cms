<?php

namespace Engine\Kernel\Template;

class Theme
{
    private const RULES_NAME_FILE = [
        'header' => 'header-%s.php',
        'footer' => 'footer-%s.php',
        'sidebar' => 'sidebar-%s.php',
    ];

    public string $url = '';

    protected array $data = [];

    public function header(string $name = null): void
    {
        if (! $name) {
            $name = 'header';
        } else {
            $name = sprintf(self::RULES_NAME_FILE['header'], $name);
        }
        $this->loadTemplateFile($name);
    }

    public function footer(string $name = null): void
    {
        if (! $name) {
            $name = 'footer';
        } else {
            $name = sprintf(self::RULES_NAME_FILE['footer'], $name);
        }
        $this->loadTemplateFile($name);
    }

    public function sidebar(string $name = null): void
    {
        if (! $name) {
            $name = 'sidebar';
        } else {
            $name = sprintf(self::RULES_NAME_FILE['sidebar'], $name);
        }
        $this->loadTemplateFile($name);
    }

    public function block(string $name = null, array $data = []): void
    {
        $this->loadTemplateFile($name, $data);
    }

    public function loadTemplateFile(string $fileName, array $data = []): void
    {
        $filePath = sprintf('%s/content/themes/default/%s.php', BASE_DIR, $fileName);

        if (! is_file($filePath)) {
            throw new \InvalidArgumentException(sprintf('File "%s" not found in %s', $fileName, $filePath));
        }

        extract($data);

        include_once $filePath;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }
}