<?php

namespace Core\ViewEngine;


class ViewEngine implements ViewEngineInterface
{
    /**
     * @var string views folder
     */
    const VIEWS_FOLDER = 'Web/Views';

    /**
     * @var string views extension
     */
    const VIEWS_EXTENSION = '.php';

    /**
     * Render view
     *
     * @param string $viewName
     * @param mixed|null $data
     */
    public function render(string $viewName, $data = null)
    {
        include self::VIEWS_FOLDER . '/' . $viewName . self::VIEWS_EXTENSION;
    }
}