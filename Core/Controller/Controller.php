<?php

namespace Core\Controller;


use Core\ViewEngine\ViewEngineInterface;

class Controller implements ControllerInterface
{
    /**
     * @var ViewEngineInterface
     */
    private $viewEngine;

    /**
     * Controller constructor.
     * @param ViewEngineInterface $viewEngine
     */
    public function __construct(ViewEngineInterface $viewEngine)
    {
        $this->viewEngine = $viewEngine;
    }

    /**
     * Renders view
     *
     * @param string $viewName
     * @param null $data
     */
    public function render(string $viewName, $data = null)
    {
        $this->viewEngine->render($viewName, $data);
    }
}