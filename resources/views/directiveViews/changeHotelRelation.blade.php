<div id="wholeModal">
    <div class="panel-heading">
        <h4 class="panel-title">
            <span class="icon-users-outline"></span>
            <label>服务调整</label>
            <span class="pull-right close" ng-click="cancel()">&#x2715</span>
        </h4>
    </div>
        <div class="panel-body">
            <div class="form-group col-sm-2">
                <ul>
                    <input ng-model="query" placeholder="搜索框： 服务名称">
                    <div>    
                        <select ng-model="area"
                                ng-options="area.name for area in areacategories">
                        全部地区 
                        </select>
                    </div>
                    <div>
                        <select ng-model="type">
                        全部类型 
                        </select>
                    </div>
                    <div>
                        <select ng-model="status">
                        全部状态 
                        </select>
                    </div>                    
                </ul>
            </div>


            <!--以下div用于显示订单列表。需要从数据库中读出的内容在comment里面标记 -->
            <div class="form-group col-sm-10">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>服务编号</td>
                            <td>服务名称</td>
                            <td>提供商</td>
                            <td>类型</td>
                            <td>服务地区</td>
                            <td>状态</td>
                            <td>删除</td>                                    
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="service in allServices  | filter:{CMB_NM:query}">
                            <td>{{service.CMB_ID}}</td>
                            <td>{{service.CMB_NM}}</td>
                            <td>{{service.MRCHNT_NM}}</td>
                            <td>{{service.MRCHNT_TP}}</td>
                            <td>{{service.MRCHNT_GEO_ID}}</td>
                            <td>{{service.CMB_STATUS}}</td>
                            <td><input type="checkbox" id={{service.CMB_ID}} ng-checked="isSelected(service.CMB_ID)" ng-click="updateSelection($event,service.CMB_ID)">
                            </td>                                                          
                        </tr>
                    </tbody>
                </table>
            </div>  
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-customized" ng-click="change(hotelID,selected)">更新</button>                                             
        </div>