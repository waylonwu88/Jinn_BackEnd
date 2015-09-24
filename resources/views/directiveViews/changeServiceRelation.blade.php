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
                            <td>酒店编号</td>
                            <td>酒店名称</td>
                            <td>地区</td>
                            <td>类型</td>
                            <td>状态</td>
                            <td></td>                                    
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="hotel in allhotels  | filter:{CMB_NM:query}">
                            <td>{{hotel.HTL_ID}}</td>
                            <td>{{hotel.HTL_NM}}</td>
                            <td>{{hotel.HTL_CT}}-{{hotel.HTL_ADDRSS}}</td>
                            <td>{{hotel.HTL_TP}}</td>
                            <td>{{hotel.HTL_STATUS}}</td>
                            <td><input type="checkbox" id={{hotel.HTL_ID}} ng-checked="isSelected(hotel.HTL_ID)" ng-click="updateSelection($event,hotel.HTL_ID)">
                            </td>                                                          
                        </tr>
                    </tbody>
                </table>
            </div>  
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-customized" ng-click="change(serviceID,selected)">更新</button>                                             
        </div>