<div id="wholeModal">
    <div class="panel-heading">
        <h4 class="panel-title">
            <span class="icon-users-outline"></span>
            <label>删除服务</label>
            <span class="pull-right close" ng-click="cancel()">&#x2715</span>
        </h4>
    </div>
        <div class="panel-body">
            <p>系统会自动向管理层发送审核。确认删除吗</p>      
        </div>
        <div>
                      <button type="button" class="btn btn-customized" ng-click="deleteService(serviceID)">确认删除</button>                             
                      <button type="button" class="btn btn-customized" ng-click="cancel()">算了</button>                                            
        </div>