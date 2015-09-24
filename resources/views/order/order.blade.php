<!DOCTYPE html>
<html>

<body>

<div class="container">
    <div class="col-md-2 sideControl">
        <ul>           
            <input ng-model="queryNo" placeholder="搜索框:订单号">

            <input ng-model="queryInfo" placeholder="搜索框:服务内容">

            <li class="btn btn-customized">
                <div ><p>操作1</p></div>
            </li>
            <li class="btn btn-customized">
                <div ><p>操作2</p></div>
            </li>
            <li class="btn btn-customized">
                <div ><p>操作3</p></div>
            </li>                                    
            <li class="btn btn-customized">
                <div ><p>操作4</p></div>
            </li>
        </ul>
    </div>

    <!--以下div用于显示订单列表。需要从数据库中读出的内容在comment里面标记 -->
    <div class="col-md-7">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>订单号</td>
                    <td>服务内容</td>
                    <td>提供商</td>
                    <td>目标酒店</td>
                    <td>发起时间</td>
                    <td>送达时间</td>
                    <td>单价</td>
                    <td>当前状态</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="order in orders | filter:{ORDR_ID:queryNo,CMB_NM:queryInfo} "
                    pop-menu  menu-type="'small-menu'" owner="order"
                    icon-n-action="iconAndAction.orderIconAction" ng-transclude                >
                    <td>{{order.ORDR_ID}}</td>
                    <td>{{order.CMB_NM}}</td>
                    <td>{{order.MRCHNT_NM}}</td>
                    <td>{{order.HTL_NM}}</td>
                    <td>{{order.ORDR_TSTMP}}</td>
                    <td>{{}}</td>
                    <td>{{order.CMB_PRC}}</td>
                    <td>{{order.STATUS}}</td>                    
                </tr>
            </tbody>
        </table>
    </div>        

    <div class="col-md-3">

    </div>
</div>
</body>
</html>