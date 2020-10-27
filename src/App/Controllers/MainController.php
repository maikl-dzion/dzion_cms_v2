<?php

namespace Dzion\App\Controllers;

use Dzion\Core\BaseController;

class MainController extends BaseController
{

    public function index() {
        echo 'index';
    }

    public function getItems() {
        echo 'get items';
    }

    public function getFindItem($id) {
        echo "get find item {$id}";
    }

    public function getUser($id, $email) {
        echo "get user {$id}, {$email}";
    }

    public function add() {
        echo "add";
    }

    public function update($id) {
        echo "update {$id}";
    }

}