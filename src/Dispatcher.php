<?php

namespace Root\Garageauto;

use Root\Garageauto\Controller\Horaires;
use Root\Garageauto\Controller\Users;

class Dispatcher
{
    private ?string $page = null;
    private ?string $id = null;
    private ?string $action = null;
    public function __construct()
    {
        if (isset($_GET['page'])) {
            $this->page = $_GET['page'];
        }
        if (isset($_GET['id'])) {
            $this->id = $_GET['id'];
        }
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        }
    }

    public function dispatch()
    {
        if (is_null($this->page) || $this->page === 'users') {
            new Users();
        } elseif ($this->page === 'horaires') {
            new Horaires();
        }
    }
}
