<!DOCTYPE html>
<html>

<body>

<div class="container">
    <div class="col-md-2 sideControl">
        <ul>
            <input ng-model="query" placeholder="搜索框:酒店名称">

            <li class="btn btn-customized">
                <div ><p>操作1</p></div>
            </li>
            <li class="btn btn-customized">
                <div ><p>操作2</p></div>
            </li>
            <li class="btn btn-customized">
                <div ><p>操作3</p></div>
            </li>                                    
            <li class="btn btn-customized" ng-click="openModal()">
                <div ><p>+ 添加新酒店</p></div>
            </li>
              <!-- Modal -->
              <div class="modal fade" id="hotelModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content modal-customized">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">新添酒店</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form>                        
                                <div class="modal-left">

                                        <!-- 酒店表格 --> 
                                        <div class="input-group input-customized">
                                            <label>酒店名称</label>
                                            <input ng-model="hotelInfo.HTL_NM"></input>
                                        </div>
                                        <div class="input-group input-customized">
                                            <label>联系人</label>
                                            <input ng-model="hotelInfo.HTL_PRM_CNTCT_NM"></input>                                
                                        </div>
                                        <div class="input-group input-customized">
                                            <label>城市</label>
                                            <input ng-model="hotelInfo.HTL_CT"></input>   
                                        </div>
                                        <div class="input-group input-customized">
                                            <label>房间数</label>
                                            <input ng-model="hotelInfo.HTL_NM_OF_RM"></input>                                   
                                        </div>                                                               
                                  
                                </div>
                                <div class="modal-right">                        
                                        <!-- 酒店表格 --> 
                                        <div class="input-group input-customized">
                                            <label>酒店类型</label>
                                            <select ng-model="hotelInfo.HTL_TP"
                                                    ng-options="hotelType.HTL_TP_NM as hotelType.HTL_TP_NM for hotelType in hotelTypes " />
                                        </div>
                                        <div class="input-group input-customized">
                                            <label>联系电话</label>
                                            <input ng-model="hotelInfo.HTL_PRM_CNTCT_PHN"></input>                                    
                                        </div>
                                        <div class="input-group input-customized">
                                            <label>地址</label>
                                            <input ng-model="hotelInfo.HTL_ADDRSS"></input>    
                                        </div>                                                                                                 
                                </div>  
                            </form> 
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-customized" ng-click="submit(hotelInfo)">添加</button>                         
                      <button type="button" class="btn btn-customized" data-dismiss="modal">关闭</button>                     
                    </div>
                  </div>
                  
                </div>
              </div>             
        </ul>
    </div>


    <!--以下div用于显示订单列表。需要从数据库中读出的内容在comment里面标记 -->
    <div class="col-md-10">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>酒店编号</td>
                    <td>酒店名称</td>
                    <td>城市</td>
                    <td>地址</td>
                    <td>类型</td>
                    <td>房间数</td>
                    <td>联系电话</td>
                    <td>录入时间</td>
                    <td>历史单量</td>
                    <td>未结款项</td>
                    <td>当前状态</td>                    
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="hotel in hotels | filter:{HTL_NM:query}"
                    pop-menu  menu-type="'small-menu'" owner="hotel"
                    icon-n-action="iconAndAction.hotelIconAction" ng-transclude>
                    <td>{{hotel.HTL_ID}}</td>
                    <td>{{hotel.HTL_NM}}</td>
                    <td>{{hotel.HTL_CT}}</td>
                    <td>{{hotel.HTL_ADDRSS}}</td>
                    <td>{{hotel.HTL_TP}}</td>
                    <td>{{hotel.HTL_NM_OF_RM}}</td>
                    <td>{{hotel.HTL_PRM_CNTCT_PHN}}</td>  
                    <td>{{hotel.HTL_INPT_TSTMP}}</td>
                    <td>{{hotel.HTL_HSTRY_ORDRS}}</td>
                    <td>{{hotel.HTL_OTSTND_AMNTS}}</td>
                    <td>{{hotel.HTL_STATUS}}</td>                                         
                </tr>
            </tbody>
        </table>
    </div>        
</div>
</body>
</html>