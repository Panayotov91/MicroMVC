<?php

namespace Core\Controller;


interface ControllerInterface
{
    /**
     * Renders view
     *
     * @param string $viewName
     * @param null $data
     */
    public function render(string $viewName, $data = null);
}