<?php

namespace Framework;

class Page extends ApplicationComponent
{

    // PROPERTIES //

    protected $contentFile;
    protected $vars = [];

    // METHODS //

    public function addVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var)) :
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle');
        endif;

        $this->vars[$var] = $value;
    }

    public function getGeneratedPage()
    {
        if (!file_exists($this->contentFile)) :
            throw new \RuntimeException('La vue spécifiée n\'existe pas');
        endif;

        $user = $this->app->user();

        extract($this->vars);

        ob_start();
        require $this->contentFile;
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . '/../../App/' . $this->app->name() . '/Templates/layout.php';
        return ob_get_clean();
    }

    // SETTER //
    public function setContentFile($contentFile)
    {
        if (!is_string($contentFile) || empty($contentFile)) :
            throw new \InvalidArgumentException('La vue spécifiée est invalide');
        endif;

        $this->contentFile = $contentFile;
    }
}
