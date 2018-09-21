<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\CheckRow;
use App\Events\AddNotice;
use App\Model\Cats;
use App\Model\Goods;

use App\Model\Index\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class GoodsController extends Controller
{
    use ModelForm;

    protected $goods_id;
    protected $user_id;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Request $request)
    {
        $status = $request->input('status');

        switch ($status) {
            case 0: $grid = $this->gridUncheck();
                    $desc = '未审核商品';
                    break;
            case 1: $grid = $this->gridChecked();
                    $desc = '已审核商品';
                    break;
            case 2: $grid = $this->gridRejected();
                    $desc = '已拒绝商品';
        }

        return Admin::content(function (Content $content) use ($grid, $desc) {

            $content->header('商品列表');
            $content->description($desc);
            $content->body($grid);
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

    function check(Request $request)
    {
        $id = $request->input('id');
        if ($id >0 ) {
            $goods = Goods::find($id);
            $goods->status = 1;
            $res = $goods->save();
            if ($res) {
                $data['status'] = true;
                $data['msg'] = '审核成功';
            } else {
                $data['status'] = false;
                $data['msg'] = '审核失败';
            }
        } else {
            $data['status'] = false;
            $data['msg'] = '系统异常';
        }
        return response()->json($data);
    }

    function reject(Request $request)
    {
        $data = $request->all();
        return Admin::content(function (Content $content) use ($data) {
            $this->goods_id = $data['id'];
            $this->user_id = $data['user_id'];
            $content->body($this->rejectForm());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function gridChecked()
    {
        return Admin::grid(Goods::class, function (Grid $grid) {

            $grid->model()->where('status', '=', 1);

            $grid->id('ID')->sortable();
            $grid->title(trans('admin.title'))->display(function ($title) {
                return mb_substr($title, 0, 5).'...';
            });
            $grid->user_id(trans('admin.mobile'))->display(function ($user_id) {
                return User::find($user_id)->mobile;
            });
            $grid->cat_id('分类')->display(function ($cat_id) {
                return mb_substr(Cats::find($cat_id)->name, 0, 5).'...';
            });
            $grid->status('状态')->display(function ($status) {
                return $status == 1 ? "已展示" : "错误";
            });
            $grid->origin_price('原价');
            $grid->after_price('券后价');
            $grid->coupon_amount('优惠券金额');
            $grid->coupon_num('优惠券数量');
            $grid->coupon_remain('优惠券剩余数量');
            $grid->rate('佣金比例');
            $grid->start_time('开始时间');
            $grid->end_time('结束时间');

            $grid->created_at(trans('admin.created_at'));
        });
    }

    protected function gridRejected()
    {
        return Admin::grid(Goods::class, function (Grid $grid) {

            $grid->model()->where('status', '=', 2);

            $grid->id('ID')->sortable();
            $grid->title(trans('admin.title'))->display(function ($title) {
                return mb_substr($title, 0, 5).'...';
            });
            $grid->user_id(trans('admin.mobile'))->display(function ($user_id) {
                return User::find($user_id)->mobile;
            });
            $grid->cat_id('分类')->display(function ($cat_id) {
                return mb_substr(Cats::find($cat_id)->name, 0, 5).'...';
            });
            $grid->status('状态')->display(function ($status) {
                return $status == 1 ? "已展示" : "错误";
            });
            $grid->origin_price('原价');
            $grid->after_price('券后价');
            $grid->coupon_amount('优惠券金额');
            $grid->coupon_num('优惠券数量');
            $grid->coupon_remain('优惠券剩余数量');
            $grid->rate('佣金比例');
            $grid->start_time('开始时间');
            $grid->end_time('结束时间');
            $grid->created_at(trans('admin.created_at'));
            $grid->actions(function ($actions) {
               $actions->disableEdit();
            });
        });
    }

    protected function gridUncheck()
    {
        return Admin::grid(Goods::class, function (Grid $grid) {

            $grid->model()->where('status', '=', 0);
            $grid->id('ID')->sortable();
            $grid->title(trans('admin.title'))->display(function ($title) {
                return mb_substr($title, 0, 5).'...';
            });
            $grid->user_id(trans('admin.mobile'))->display(function ($user_id) {
                return User::find($user_id)->mobile;
            });
            $grid->cat_id('分类')->display(function ($cat_id) {
                return mb_substr(Cats::find($cat_id)->name, 0, 5).'...';
            });
            $grid->status('状态')->display(function ($status) {
                return $status == 0 ? "未审核" : "已审核";
            });
            $grid->origin_price('原价');
            $grid->after_price('券后价');
            $grid->coupon_amount('优惠券金额');
            $grid->coupon_num('优惠券数量');
            $grid->coupon_remain('优惠券剩余数量');
            $grid->rate('佣金比例');
            $grid->start_time('开始时间');
            $grid->end_time('结束时间');
            $grid->disableCreateButton();
            $grid->disableFilter();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $data['id'] = $actions->row->id;
                $data['url'] = 'check';
                $check = new CheckRow($data);
                unset($data['url']);
                $data['user_id'] = $actions->row->user_id;
                $reject = route('goods.reject', $data);
                $actions->append($check);
                $actions->append("<a href=$reject > 拒绝</a>");
            });

            $grid->created_at(trans('admin.created_at'));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Goods::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', trans('admin.title'))->rules('required');
            $form->select('cat_id', '分类')->options('/api/cats')->rules('required');
            $form->text('rate', '佣金比例');
            $form->select('status', '状态')->options(['0'=>'未审核', '1'=>'已展示', '2'=>'已拒绝']);
            $form->textarea('copy_text', '文案')->rules('required');
            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at',  trans('admin.updated_at'));

//            $form->hidden('cat_id');
        });
    }

    protected function rejectForm()
    {
        $user_id = $this->user_id;
        $goods_id = $this->goods_id;
        $form = new \Encore\Admin\Widgets\Form();
        $form->action(route('goods.dealReject'));
        $form->text('title', trans('admin.title'));
        $form->textarea('desc', trans('admin.desc'));

        $form->hidden('user_id')->default($user_id);
        $form->hidden('goods_id')->default($goods_id);

        return $form;
    }

    function dealReject(Request $request)
    {
        $data = $request->all();
        $id = $data['goods_id'];
        $res = \DB::table('goods')->where('id', '=', $id)->update(['status'=>2]);
        if ($res) {
            event(new AddNotice($data));
        }
        admin_toastr('拒绝成功', 'success');
        return redirect('/admin/goods/goods');
    }
}
