<?php

namespace App\Admin\Controllers;

use App\Model\Photo;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PhotoController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('手机轮播');
            $content->description('轮播列表');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Photo::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title(trans('admin.title'));
            $grid->link('链接')->display(function ($link) {
                return strlen($link) < 30 ? $link : mb_substr($link, 0 ,30);
            });
            $grid->desc(trans('admin.desc'));
            $grid->created_at(trans('admin.created_at'));
            $grid->updated_at(trans('admin.updated_at'));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Photo::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title',trans('admin.title'));
            $form->image('img_url','图片');
            $form->text('link','链接');
            $form->text('sort','排序');
            $form->textarea('desc',trans('admin.desc'));
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });
    }

}
