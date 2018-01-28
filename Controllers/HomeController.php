<?php

namespace Controllers;


use Core\Controller\Controller;
use Database\DatabaseInterface;
use Services\TestServiceInterface;

class HomeController extends Controller
{
    public function home(string $testParameter, TestServiceInterface $testService, DatabaseInterface $database)
    {
        $this->render('Home');
        echo "<br>";
        $testService->TestPrint();
        echo "<br>";
        echo "Test parameter: $testParameter";
    }
}