<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\ChargeSet;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;


class ChargeController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('充值');
            $content->description('积分设置');

            $content->body($this->grid());
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->body($this->form());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->body($this->form()->edit($id));
        });
    }

    function grid()
    {
        return Admin::grid(ChargeSet::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->cny('金额');
            $grid->integral('积分');

            $grid->created_at(trans('admin.created_at'));
            $grid->updated_at(trans('admin.updated_at'));
        });
    }

    protected function form()
    {
        return Admin::form(ChargeSet::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('cny', '金额');
            $form->text('integral', '积分');

            $form->hidden('created_at', 'Created At');
            $form->hidden('updated_at', 'Updated At');
        });
    }
}
