<!DOCTYPE html>
<html>

<body>

<div class="container">
    <div class="col-md-2 sideControl">
        <ul>
            <input ng-model="query" placeholder="搜索框:服务名称">

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
                <div ><p>+ 添加新服务</p></div>
            </li>
              <!-- Modal -->
              <div class="modal fade" id="serviceModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content modal-customized">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">新添服务</h4>
                    </div>
                    <div class="modal-body">
                        <form>                        
                            <div class="modal-left">

                                    <!-- 服务表格 --> 
                                    <div class="input-group input-customized">
                                        <label>提供商</label>
                                        <input ng-model="merchantInfo.MRCHNT_NM"></input> 
                                        <p class="btn btn-customized" ng-click="queryInfo(serviceInfo.MRCHNT_NM)">
                                            <label>查询</label>  
                                        </p>                                                                    
                                    </div>                                    
                                    <div class="input-group input-customized">
                                        <label>服务名称</label>
                                        <input ng-model="serviceInfo.CMB_NM"></input>
                                    </div>
                                    <div class="input-group input-customized">
                                        <label>覆盖范围</label>
                                        <select ng-model="merchantInfo.MRCHNT_CVR"
                                        ng-options="area.name as area.name for area in areacategories"></select>   
                                    </div>
                                    <div class="input-group input-customized">
                                        <label>单价</label>
                                        <input ng-model="serviceInfo.CMB_PRC"></input>                                   
                                    </div>                                                               
                              
                            </div>
                            <div class="modal-right">                        
                                    <!-- 服务表格 --> 
                                    <div class="input-group input-customized">
                                        <label>服务类型</label>

                                       <select ng-model="merchantInfo.MRCHNT_TP"
                                                ng-options="serviceType.SRVC_TP_NM as serviceType.SRVC_TP_NM for serviceType in serviceTypes "/>
                                    </div>
                                    <div class="input-group input-customized">
                                        <label>联系电话</label>
                                        <input ng-model="merchantInfo.MRCHNT_PHN"></input>                                    
                                    </div>
                                    <div class="input-group input-customized">
                                        <label>服务方式</label>
                                        <select ng-model="serviceInfo.CMB_MTHD"
                                        ng-options="service.option as service.option for service in servicecategories">                                         
                                        </select>    
                                    </div>
                                    
                                                             
                            </div>
                        </form> 
                         <div>
                            <form name="myForm" action="fileupload" class="dropzone" id="my-dropzone" method="post" class = "form single-dropzone" enctype="multipart/form-data">
                              <br>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <button id="upload-submit" class="btn btn-default margin-t-5" ><i class="fa fa-upload" ></i> 上传图片</button>                                                                                                    
                            </form> 

                        </div>   
                        </form>
                            <div class="input-group input-customized">
                                <label>备注</label>
                                <textarea rows="3" ng-model="serviceInfo.CMB_RMRK"></textarea>
                            </div>  
                        </form>      
 
                                                                       
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-customized" ng-click="submit(serviceInfo,merchantInfo)">添加</button>                             
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
                    <td>服务编号</td>
                    <td>服务名称</td>
                    <td>提供商</td>
                    <td>类型</td>
                    <td>服务地区</td>
                    <td>服务方式</td>
                    <td>加入时间</td>
                    <td>单价</td>
                    <td>未结款项</td>
                    <td>状态</td>
                    <td>备注</td>                                    
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="service in services  | filter:{CMB_NM:query}"
                    pop-menu  menu-type="'small-menu'" owner="service"
                    icon-n-action="iconAndAction.serviceIconAction" ng-transclude>                
                    <td>{{service.CMB_ID}}</td>
                    <td>{{service.CMB_NM}}</td>
                    <td>{{service.MRCHNT_NM}}</td>
                    <td>{{service.MRCHNT_TP}}</td>
                    <td>{{service.MRCHNT_CVR}}</td>
                    <td>{{service.CMB_MTHD}}</td>
                    <td>{{service.CMB_INPT_TSTMP}}</td>
                    <td>{{service.CMB_PRC}}</td>
                    <td>{{service.CMB_OTSTND_AMNTS}}</td> 
                    <td>{{service.CMB_STATUS}}</td>
                    <td>{{service.CMB_RMRK}}</td>                                                             
                </tr>
            </tbody>
        </table>
    </div>  
</div>
</body>
</html>