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
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="/">大管家系统</a></li>
            <li><a href="/orders">订单管理</a></li>
            <li class="active">编辑订单 / <span>{{$order->o_num}}</span></li>
            <li><span onclick="history.go(-1)">返回上一页</span></li>
        </ol>
    </div>

    <form action="/orders/update/{{$order->o_num}}" method="post">
        {{csrf_field()}}
        <div class="col-md-12">
            <div class="col-md-12 bg-pray" style="height: 40px; line-height: 40px;font-size: 16px;border-top-left-radius:5px; border-bottom-left-radius:5px;">
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
                        <input type="text" class="form-control" id="o_linkman" name="o_linkman" value="{{$order->o_linkman}}">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="o_user_sex" name="o_user_sex">
                            <option value="1" {{$order->o_user_sex == 1 ? "selected" : ""}}>先生</option>
                            <option value="2" {{$order->o_user_sex == 2 ? "selected" : ""}}>女士</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="o_num" style="color: green">用户名: {{$order->o_user}}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="ordernum">订单状态：</label>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-xs btn-warning">{{$order->o_custom_state}}</button>
                    {{--<select name="orderstatus" id="orderstatus" class="form-control">
                        <option value="1" {{$order->o_state == 1? "selected='selected'" : ''}}>新订单</option>
                        <option value="2" {{$order->o_state == 2? "selected='selected'" : ''}}>待确认</option>
                        <option value="3" {{$order->o_state == 3? "selected='selected'" : ''}}>已接受</option>
                        <option value="4" {{$order->o_state == 4? "selected='selected'" : ''}}>已确认</option>
                        <option value="5" {{$order->o_state == 5? "selected='selected'" : ''}}>已出发</option>
                        <option value="6" {{$order->o_state == 6? "selected='selected'" : ''}}>搬家中</option>
                        <option value="7" {{$order->o_state == 7? "selected='selected'" : ''}}>未支付</option>
                        <option value="8" {{$order->o_state == 8? "selected='selected'" : ''}}>已支付</option>
                        <option value="9" {{$order->o_state == 9? "selected='selected'" : ''}}>已结束</option>
                    </select>--}}
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
                            <input class="form_datetime form-control" size="16" type="text" id="removetime" name="removetime" value="{{$order->removetime}}">
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
                    <input type="text" class="form-control" name="o_linkman_tel" value="{{$order->o_linkman_tel}}">
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">备注：</label>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="o_remark" value="{{$order->o_remark}}">
                </div>
            </div>
            {{--价格信息开始--}}
            <div class="col-md-12 bg-pray" style="height: 40px; line-height: 40px;font-size: 16px;border-top-left-radius:5px; border-bottom-left-radius:5px;">
                <label for="">价格信息</label>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-4">
                    <div class="col-md-6">
                        <label for="ordernum">人工/时间价格：</label>

                        @if($order->o_state < 7)
                            <span for="o_num" style="color:red;">{{$order->o_start_price}}元</span>
                        @else
                            <span for="o_num" style="color:red;">{{$order->o_time_price}}元</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="ordernum">里程价格：</label>
                        <label for="o_num" style="color:red;">{{$order->o_mileage_price != null ? $order->o_mileage_price : "0.00"}}元</label> {{$order->o_mileage_intro}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-6">
                        <label for="ordernum">特殊时段费：</label>
                        <label for="o_num" style="color:red;">{{$order->o_special_time_price != null ? $order->o_special_time_price : "0.00" }}元</label>{{--　{{$order->o_special_time_price_intro}}--}}
                    </div>
                    <div class="col-md-6">
                        <label for="ordernum">总价(无附加费)：</label>
                        <label for="o_num" style="color:red;">{{$order->o_price != null ? $order->o_price :"0.00"}}元</label> (无折扣)
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-6">
                        <div class="col-md-5">
                            <label for="ordernum">折扣价格：</label>
                        </div>
                        <div class="col-md-7">
                            @if($order->o_state == 7)
                            <input type="text" class="form-control" id="activityprice" name="activityprice" onblur="javascript:CheckInputIntFloat(this)" value="{{$order->o_activity_price != null ? $order->o_activity_price : $order->o_estimate_price}}">
                            @else
                            <span>{{$order->o_activity_price != null ? $order->o_activity_price : $order->o_estimate_price}}</span>
                            <input type="hidden" id="activityprice" name="activityprice" onblur="javascript:CheckInputIntFloat(this)" value="{{$order->o_activity_price != null ? $order->o_activity_price : $order->o_estimate_price}}">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="ordernum">应付金额：</label>
                        @if($order->o_state < 7)
                            <label for="o_num" style="color:red;">{{$order->o_estimate_price}}元</label>
                        @else
                            <label for="o_num" style="color:red;">{{$order->o_final_price}}元</label> ( 含附加费{{$order->o_other_charge}}元 )
                        @endif
                    </div>
                </div>
            </div>
            @if($othercharge != null)
                <div class="col-md-12 custom-border-bottom">
                    <div class="col-md-12">
                        <div class="col-md-2"><label for="">计费项目：</label></div>
                        <div class="col-md-1">过路费</div>
                        <div class="col-md-1">停车费</div>
                        <div class="col-md-1">钢琴搬运费</div>
                        <div class="col-md-1">中途卸装费</div>
                        <div class="col-md-1">等待时间费</div>
                        <div class="col-md-1">空调移机费</div>
                        <div class="col-md-1">1.5~1.8鱼缸</div>
                        <div class="col-md-1">贵重物品保险</div>
                        <div class="col-md-1">其他费用</div>
                    </div>
                </div>
                <div class="col-md-12 custom-border-bottom">
                    <div class="col-md-12">
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
                </div>
            @endif
            {{--价格信息结束--}}
            <div class="col-md-12 bg-pray" style="height: 40px; line-height: 40px;font-size: 16px;border-top-left-radius:5px; border-bottom-left-radius:5px;">
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
                <div class="col-md-2">
                    <label for="ordernum">搬运工人数：</label>
                </div>
                <div class="col-md-1">
                    <span>{{$order->o_worker_count}} 人</span>
                </div>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-2">
                    <label for="ordernum">里程数：</label>
                </div>
                <div class="col-md-4">
                    <label for="o_num" style="color:green;">{{$order->o_mileage}}KM</label>
                </div>
            </div>
            <div class="col-md-12 bg-pray" style="height: 40px; line-height: 40px;font-size: 16px;border-top-left-radius:5px; border-bottom-left-radius:5px;">
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

            <div class="col-md-12 bg-pray" style="height: 40px; line-height: 40px;font-size: 16px;border-top-left-radius:5px; border-bottom-left-radius:5px;">
                <label for="">其它信息</label>
            </div>
            <div class="col-md-12 custom-border-bottom">
                <div class="col-md-4">
                    <div class="col-md-4">
                        <label for="ordernum">跟踪客服：</label>
                    </div>
                    <div class=2"col-md-8">
                        @if($order->customService != '')
                            <label for="o_num">{{$order->customService}}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-4">
                        <label for="ordernum">下单客户端：</label>
                    </div>
                    <div class="col-md-8">
                        <label  for="o_num">{{$order->o_and_state == 1 ? "" : "安卓"}}{{$order->o_ios_state == 1 ? "iOS" : ""}}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-4">
                        <label for="ordernum">支付途径：</label>
                    </div>
                    @if($payinfo != null)
                        <div class="col-md-8">
                            {{$payinfo->p_class}}  [订单编号：<label for="o_num">{{$payinfo->p_num}}</label>]
                        </div>
                    @endif
                </div>
            </div>
            @if(count($records) > 0)
            <div class="accordion" id="accordion-316003">
                <div class="accordion-group">
                    <div class="accordion-heading col-md-12 bg-primary custom-border-bottom">
                        <div class="accordion-toggle" href="#accordion-element-808478 " data-toggle="collapse" data-parent="#accordion-316003" style="height: 40px; line-height: 40px;font-size: 16px;">
                            <label for="">客服跟进记录</label>
                        </div>
                    </div>
                    <div class="accordion-body in" id="accordion-element-808478">
                        <div class="col-md-12 custom-border-bottom">
                            <div class="col-md-1 "><span class="btn btn-xs btn-primary">跟进客服</span></div>
                            <div class="col-md-9 "><span class="btn btn-xs btn-primary">跟进记录</span></div>
                            <div class="col-md-2 "><span class="btn btn-xs btn-primary">跟进时间</span></div>
                        </div>
                        <div class="accordion-inner">
                            @foreach($records as $record)
                                <div class="col-md-12 custom-border-bottom">
                                    <div class="col-md-1">{{$record->user_id}}</div>
                                    <div class="col-md-9">{{$record->customer_record}}</div>
                                    <div class="col-md-2">{{$record->created_at}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-4 col-md-offset-8 custom-margin-top-15">
                @if($order->o_state < 8 )
                    <div class="col-md-4"><button type="submit" class="btn btn-block btn-success btn-lg">提交修改</button></div>
                    <div class="col-md-4"><a href="/orders/show/{{$order->o_num}}" class="btn btn-block btn-warning btn-lg">撤销修改</a></div>
                    <div class="col-md-4"><button type="submit" class="btn btn-block btn-info btn-lg" onclick="history.go(-1)">返回上一页</button></div>
                @else
                    <div class="col-md-4 col-md-offset-6"><a class="btn btn-block btn-warning btn-lg disabled">订单已完成</a></div>
                @endif
            </div>
        </div>
    </form>
    @endif
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});

    function CheckInputIntFloat(oInput)
    {
        var num = document.getElementById("activityprice").value;
        if (num==""){
            alert("请输入折扣后价格");return false;
        }
        if(num < 0 ){
            alert("请输入正确的价格");return false;
        }
        if (!(/(^[1-9]\d*$)/).test(num) && !(/(^(-?\d+)(\.\d+)?$)/).test(num) ){
            alert("请输入正确的价格");return false;
        }
    }
</script>
@endsection
