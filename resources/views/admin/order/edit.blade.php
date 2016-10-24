@extends('main')

@section('title','! 大管家管理系统')

@section('content')

    @if(Session::has('showOrderFaild'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                &times;
            </button>
            <strong>Warnning:</strong>{{  Session::get('showOrderFaild') }}　<label for=""><a href="/orders">查看所有订单信息</a></label>
        </div>
    @endif


    @if($order != null)
    <form action="/order/update" method="post">
        {{csrf_field()}}
        <div class="col-md-12">
            <div class="col-md-12 bg-info" style="height: 40px; line-height: 40px;font-size: 16px;">
                <label for="">订单信息</label>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">订单编号：</label>
                </div>
                <div class="col-md-4" style="color: green">
                    <label for="o_num">{{$order->o_num}}</label>
                </div>
                <div class="col-md-2">
                    <label for="ordernum">搬家城市：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num">{{$order->o_city}}</label>
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">客户：</label>
                </div>
                <div class="col-md-4">
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="o_linkman" placeholder="{{$order->o_linkman}}">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="o_user_sex">
                            <option name="1" {{$order->o_user_sex == 1 ? "selected" : ""}}>先生</option>
                            <option name="2" {{$order->o_user_sex == 2 ? "selected" : ""}}>女士</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="o_num" style="color: green">用户名: {{$order->o_user}}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="ordernum">订单状态：</label>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-xs btn-warning">{{$order->o_custom_state}}</button>
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">下单时间：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num">{{$order->o_time}}</label>
                </div>
                <div class="col-md-2">
                    <label for="ordernum">预约时间：</label>
                </div>
                <div class="col-md-4">
                    <div class="col-md-4">
                        <div class="layui-inline">
                            {{--layui-input 默认的input样式组--}}
                            <input class="form-control" placeholder="{{$order->o_time}}" onclick="layui.laydate({elem: this, istime: false, format: 'YYYY-MM-DD hh:mm',  istoday: false,festival: true,issure: true})">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="timewarning" style="color: red;"> * 请选择当前时间3小时后的预定时间</label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">电话：</label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="o_linkman_tel" placeholder="{{$order->o_linkman_tel}}">
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">备注：</label>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="o_remark" placeholder="{{$order->o_remark}}">
                </div>
            </div>
            <div class="col-md-12 bg-info" style="height: 40px; line-height: 40px;font-size: 16px;">
                <label for="">价格信息</label>
            </div>

            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">人工/时间价格：</label>
                </div>
                @if($order->o_state < 7)
                    <div class="col-md-4">
                        <label for="o_num" style="color:red;">{{$order->o_start_price}}元</label>
                    </div>
                @else
                    <div class="col-md-4">
                        <label for="o_num" style="color:red;">{{$order->o_time_price}}元</label>
                    </div>
                @endif
                <div class="col-md-2">
                    <label for="ordernum">里程价格：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num" style="color:red;">{{$order->o_mileage_price != null ? $order->o_mileage_price : "0.00"}}元</label> {{$order->o_mileage_intro}}
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">特殊时段费：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num" style="color:red;">{{$order->o_special_time_price != null ? $order->o_special_time_price : "0.00" }}元</label>　{{$order->o_special_time_price_intro}}
                </div>
                <div class="col-md-2">
                    <label for="ordernum">总价（不含附加费）：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num" style="color:red;">{{$order->o_price != null ? $order->o_price :"0.00"}}元</label> ( 没有折扣的原始价格 )
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">折扣后价格（不含附加费）：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num" style="color:red;">{{$order->o_activity_price != null ? $order->o_activity_price : "0.00"}}元</label>　{{$order->o_activity}} 折
                </div>
                <div class="col-md-2">
                    <label for="ordernum">最终价格：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num" style="color:red;">{{$order->o_final_price}}元</label>
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">预估总价：</label>
                </div>
                @if($order->o_state < 7)
                    <div class="col-md-10">
                        <label for="o_num" style="color:red;">{{$order->o_estimate_price}}元</label>
                    </div>
                @else
                    <div class="col-md-10">
                        <label for="o_num" style="color:red;">{{$order->o_final_price}}元</label> ( 含附加费{{$order->o_other_charge}}元 )
                    </div>
                @endif
            </div>
            @if($othercharge != null)
                <div class="col-md-12 custom-border-bottom">
                    <div class="col-md-2"><label for="">计费项目：</label></div>
                    <div class="col-md-1">过路费</div>
                    <div class="col-md-1">停车费</div>
                    <div class="col-md-1">钢琴搬运费</div>
                    <div class="col-md-1">中途卸装费</div>
                    <div class="col-md-1">等待时间费</div>
                    <div class="col-md-1">空调移机费</div>
                    <div class="col-md-1">1.5~1.8米鱼缸</div>
                    <div class="col-md-1">贵重物品保险费</div>
                    <div class="col-md-1">其他费用</div>
                </div>
                <div class="col-md-12 custom-border-bottom">
                    <div class="col-md-2"><label for="">费用详情：</label></div>
                    <div class="col-md-1">{{$othercharge->c_road}}元</div>
                    <div class="col-md-1">{{$othercharge->c_parking}}元</div>
                    <div class="col-md-1">{{$othercharge->c_piano}}元</div>
                    <div class="col-md-1">{{$othercharge->c_reload}}元</div>
                    <div class="col-md-1">{{$othercharge->c_waiting}}元</div>
                    <div class="col-md-1">{{$othercharge->c_kongtiao}}元</div>
                    <div class="col-md-1">{{$othercharge->c_yugang1}}元</div>
                    <div class="col-md-1">{{$othercharge->c_valuable}}元</div>
                    <div class="col-md-1">{{$othercharge->c_other}}元</div>
                </div>
            @endif
            <div class="col-md-12 bg-info" style="height: 40px; line-height: 40px;font-size: 16px;">
                <label for="">地点和车辆信息</label>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">起点-终点：</label>
                </div>
                <div class="col-md-10">
                    <label for="o_num" style="color:blue;">{{$order->o_begin_poi_address}}</label>　到　<label for="o_num" style="color:blue;">{{$order->o_end_poi_address}}</label>
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">套餐：</label>
                </div>
                <div class="col-md-4">
                    {{--@if($carinfo != null)
                    <div class="col-md-2">
                        <label for="o_num">{{$carinfo->car_name}}</label>
                    </div>
                    @endif--}}
                    <div class="col-md-4">
                        <select class="form-control" id="car_name">
                            @foreach($carcanused as $k=>$v)
                            <option name="{{$v->car_type_num}}" {{$order->o_car_inclusive == $v->car_type_num ? "selected" : ""}}>{{$v->car_name}}[{{$v->car_format}}]</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="ordernum">搬运工人数：</label>
                </div>
                <div class="col-md-1">
                    <input type="number" class="form-control" name="o_num" min="1" max="10" value="{{$order->o_worker_count}}">
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">里程数：</label>'
                </div>
                <div class="col-md-4">
                    <label for="o_num" style="color:green;">{{$order->o_mileage}}KM</label>
                </div>
            </div>
            <div class="col-md-12 bg-info" style="height: 40px; line-height: 40px;font-size: 16px;">
                <label for="">其它信息</label>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">跟踪客服：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num">{{$order->customService}}</label>
                </div>
                <div class="col-md-2">
                    <label for="ordernum">下单客户端：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num">{{$order->o_and_state == 1 ? "" : "安卓"}}{{$order->o_ios_state == 1 ? "iOS" : ""}}</label>
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">支付途径：</label>
                </div>
                @if($payinfo != null)
                    <div class="col-md-4">
                        {{$payinfo->p_class}}  [订单编号：<label for="o_num">{{$payinfo->p_num}}</label>]
                    </div>
                @endif
            </div>
            <div class="col-md-12 bg-info" style="height: 40px; line-height: 40px;font-size: 16px;">
                <label for="">搬家公司信息</label>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">搬家公司编号：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num">{{$order->o_remover_num}}</label>
                </div>
                <div class="col-md-2">
                    <label for="ordernum">搬家车组：</label>
                </div>
                <div class="col-md-2">
                    <label for="o_num" >{{$order->o_worker_name}} [ {{$order->o_plate_num}}  ]</label>
                </div>
                <div class="col-md-2 column">
                    <a id="modal-833932" href="#modal-container-833932" role="button" class="btn btn-primary" data-toggle="modal" onclick="showcheck()" >指派订单给司机</a>
                    {{--<div class="modal fade" id="modal-container-833932" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="col-md-8">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <input type="text" class="form-control" placeholder="请输入司机手机号码..." id="phonenum">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="button" id="checkuser" onclick="checkusers()" class="form-control" value="点此查询">
                                    </div>
                                </div>
                                @if($worker)
                                    <div>1231231123</div>
                                @endif
                                <div class="modal-body" id = "showdrivers">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> <button type="button" class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">状态：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num">未知!!!!!!!</label>
                </div>
                <div class="col-md-2">
                    <label for="ordernum">搬家状态：	</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num">{{$order->o_remover_state}}</label>
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">搬家时间记录：</label>
                </div>
                <div class="col-md-2">
                    <label for="o_num">搬出开始：</label>{{$order->o_out_begin_time}}
                </div>
                <div class="col-md-2">
                    <label for="o_num">搬出结束：</label>{{$order->o_out_end_time}}
                </div>
                <div class="col-md-2">
                    <label for="o_num">搬入开始：</label>{{$order->o_in_begin_time}}
                </div>
                <div class="col-md-2">
                    <label for="o_num">搬入结束：</label>{{$order->o_in_end_time}}
                </div>
            </div>
            <div class="col-md-4 col-md-offset-8 custom-margin-top-15">
                @if($order->o_state < 8 )
                    <div class="col-md-6"><button type="submit" class="btn btn-block btn-success btn-lg">提交修改</button></div>
                    <div class="col-md-6"><a href="/orders/show/{{$order->o_num}}" class="btn btn-block btn-warning btn-lg">撤销修改</a></div>
                @else
                    <div class="col-md-6 col-md-offset-6"><a class="btn btn-block btn-warning btn-lg">订单已完成</a></div>
                @endif
            </div>
        </div>
    </form>
    <div id="bg"></div>
    <div class="col-md-offset-2 col-md-8" id="checkdiv">
        <div class="col-md-12" style="margin-top: 10px;">
            <div class="col-md-4 col-md-offset-6">
                {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
                <input type="text" class="form-control" placeholder="请输入司机手机号码..." id="phonenum">
            </div>
            <div class="col-md-2">
                <input type="button" id="checkuser" onclick="check()" class="form-control" value="点此查询">
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
    </div>
    @endif
@endsection

<script>
    function check() {
        var phonenum = document.getElementById("phonenum").value;
        if(phonenum==""){
            alert("请填写司机手机号码...");
            return;
        }
        if(isNaN(phonenum))
        {
            alert("请输入正确的手机号码,不要输入英文,~");
            return;
        }
        $.ajax({
            type: 'GET',
            url: '/test',
            data: { phonenum : phonenum},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                if(data.status == 402){
                    alert(data.msg);
                    return;
                }
                console.log(data.data);
            },
            error: function(xhr, type){
                alert('Ajax error!')
            }
        });
    }
    function checkuser() {
        var phonenum = document.getElementById("phonenum").value;
        alert(123);
        $.ajax({
            type: 'GET',
            url: '/test',
            data: { phonenum : phonenum},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                console.log(data.data);
            },
            error: function(xhr, type){
                alert('Ajax error!')
            }
        });
    }
    function showcheck() {
        document.getElementById("bg").style.display ="block";
        document.getElementById("checkdiv").style.display ="block";
    }

</script>
