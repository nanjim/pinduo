<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use App\Model\Index\User;
class AdminController extends Controller
{
    public function index()
    {
        return 123;
    }

    public function getUsers()
    {

    }
}
