<?php

namespace Core\ViewEngine;


interface ViewEngineInterface
{
    /**
     * Render view
     *
     * @param string $viewName
     * @param mixed|null $data
     */
    public function render(string $viewName, $data = null);
}