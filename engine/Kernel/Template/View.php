<?php

namespace Engine\Kernel\Template;

class View
{
    protected Theme $theme;

    public function __construct()
    {
        $this->theme = new Theme();
    }

    public function render(string $template, array $vars = []): void
    {
        $templatePath = sprintf('%s/content/themes/default/%s.php', BASE_DIR, $template);
        if (! is_file($templatePath)) {
            throw new \InvalidArgumentException(sprintf('Template "%s" not found in %s', $template, $templatePath));
        }

        $this->theme->setData($vars);
        extract($vars);

        ob_start();
        ob_implicit_flush(0);

        try {
            require $templatePath;
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }

        echo ob_get_clean();
    }
}