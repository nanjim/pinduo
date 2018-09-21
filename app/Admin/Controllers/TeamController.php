<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\CheckRow;
use App\Model\Index\Team;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\InfoBox;
use Illuminate\Http\Request;
use App\Events\AddNotice;

class TeamController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Request $request)
    {
        $status = $request->input('status');

        switch ($status) {
            case 0: $grid = $this->gridUnchecked();
                    break;
            case 1: $grid = $this->gridChecked();
                    break;
            case 2: $grid = $this->gridRejected();
                    break;
            default: $grid = $this->gridChecked();
        }

        return Admin::content(function (Content $content) use ($grid) {

            $content->header('放单团队');
            $content->description('已审核');

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

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function gridChecked()
    {
        return Admin::grid(Team::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->name(trans('admin.name'));
            $grid->type(trans('admin.type'))->display(function ($type) {
                return $type == 1 ? "个人" : "团队";
            });
            $grid->qq(trans('admin.qq'));
            $grid->weixin(trans('admin.weixin'));
            $grid->income('收入');
            $grid->desc(trans('admin.desc'));
            $grid->status(trans('admin.status'))->display(function ($status) {
                return $status ? '已审核' : '待审核';
            });
            $grid->column('user.mobile',trans('admin.mobile'));
            $grid->created_at(trans('admin.created_at'));
            $grid->updated_at(trans('admin.updated_at'));

            $grid->model()->where('status', '=', 1);
//
            $grid->disableCreateButton();
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('name', '团队名称');
            });

            $grid->disableExport();
            $grid->disableRowSelector();

        });
    }

    protected function gridUnchecked()
    {
        return Admin::grid(Team::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name(trans('admin.name'));
            $grid->type(trans('admin.type'))->display(function ($type) {
                return $type == 1 ? "个人" : "团队";
            });
            $grid->qq(trans('admin.qq'));
            $grid->weixin(trans('admin.weixin'));
            $grid->income('收入');
            $grid->desc(trans('admin.desc'));
            $grid->status(trans('admin.status'))->display(function ($status) {
                return $status ? '已审核' : '待审核';
            });
            $grid->column('user.mobile', trans('admin.mobile'));
            $grid->created_at(trans('admin.created_at'));
            $grid->updated_at(trans('admin.updated_at'));
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $user_id = $actions->row->user_id;
                $team_id = $actions->row->id;
                $checkReject = route('team.reject', ['user_id'=>$user_id, 'team_id'=>$team_id]);
                $data['id'] = $team_id;
                $data['url'] = 'checkPass';
                $checkRow = new CheckRow($data);
                $actions->append($checkRow);
                $actions->append("<a href=$checkReject> 拒绝 </a>");
            });

            $grid->model()->where('status', '=', 0);

            $grid->disableCreateButton();
            $grid->disableFilter();
            $grid->disableExport();
            $grid->disableRowSelector();
        });
    }

    protected function gridRejected()
    {
        return Admin::grid(Team::class, function (Grid $grid) {

            $grid->model()->where('status', '=', 2);
            $grid->id('ID')->sortable();
            $grid->name(trans('admin.title'));
            $grid->desc(trans('admin.desc'));
            $grid->status('状态')->display(function ($status) {
                return $status == 2 ? '已拒绝' : '错误';
            });
            $grid->column('user.mobile',trans('admin.mobile'));
            $grid->created_at(trans('admin.created_at'));
            $grid->updated_at(trans('admin.updated_at'));

            $grid->disableCreateButton();
            $grid->actions(function ($actions) {
                $actions->disableEdit();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Team::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', trans('admin.name'));
            $form->radio('type', '类型')->options(['1'=>'个人','2'=>'团队']);
            $form->text('qq', trans('admin.qq'));
            $form->text('weixin', trans('admin.weixin'));
            $form->text('income', '收入');
            $form->textarea('desc', trans('admin.desc'));
            $form->display('user.name', '用户');
            $form->radio('status', '审核状态')->options(['0'=>'未审核', '1'=>'已审核']);

            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        });
    }

    protected function rejectForm($data)
    {
        $user_id = $data['user_id'];
        $team_id = $data['team_id'];
        $form = new \Encore\Admin\Widgets\Form();
        $form->action("/admin/teams/dealReject");
        $form->text('title','标题')->rules('required');
        $form->textarea('desc','描述');
        $form->hidden('user_id')->default($user_id);
        $form->hidden('team_id')->default($team_id);
        $form->hidden('_token')->default(csrf_token());

        return $form;
    }

    function checkPass(Request $request)
    {
        $id = $request->input('id');
        if ($id > 0) {
            $team = Team::find($id);
            $team->status = 1;
            $res = $team->save();
            if ($res) {
                $data['status'] = true;
                $data['msg'] = "审核成功";
            } else {
                $data['status'] = false;
                $data['msg'] = "审核失败";
            }

        } else {
            $data['status'] = false;
            $data['msg'] = "该团队不存在";
        }
        return response()->json($data);
    }

    function showReject(Request $request)
    {
        $data['user_id'] = $request->input('user_id');
        $data['team_id'] = $request->input('team_id');

        return Admin::content(function (Content $content) use ($data) {
            $content->body($this->rejectForm($data));
        });
    }

    /**
     * @param Request $request
     * status 0：未审核; 1： 已审核； 2：已拒绝
     */
    function dealReject(Request $request)
    {
        $req = $request->all();
        $team_id = $req['team_id'];
        event(new AddNotice($req));
        \DB::table('teams')->where('id', '=', $team_id)->update(['status'=>2]);
        admin_toastr('拒绝成功', 'success');
        return redirect('/admin/teams/teamsUnchecked');
    }

    function test()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');
            $infoBox = new InfoBox('New Users', 'users', 'aqua', '/admin/users', '1024');
            $content->body($infoBox);
        });

    }

}
