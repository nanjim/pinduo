<?php

namespace App\Admin\Extensions;

use Encore\Admin\Facades\Admin;

class CheckRow{

    protected $id;
    protected $url;

    function __construct($data)
    {
        $this->id = $data['id'];
        $this->url = $data['url'];
    }

    function script()
    {
        return <<<SCRIPT
        $(".grid-check-row").click(function(){
            
            var id = $(this).data('id');
            var url = $(this).data('url');
            swal({
                title: '确定审核通过吗？',
                type: 'warning',
                showCancelButton: true, 
                confirmButtonColor: 'red',
                cancelButtonColor: '#d33',
                cancelButtonText: '取消',
                confirmButtonText: '确认',
               
            },
            function(){
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {'id': id},
                    success: function(res){
                        console.log(res);
                        $.pjax.reload('#pjax-container');
                        if(res.status){
                            swal(res.msg, '', 'success');
                        }else{
                            swal(res.msg, '', 'error');
                        }
                    }
                });
            });
        });
SCRIPT;

    }

    function render()
    {
        Admin::script($this->script());
        return "<a class='grid-check-row' data-id='{$this->id}' data-url='{$this->url}'>审核</a>";
    }

    function __toString()
    {
        return $this->render();
    }

}