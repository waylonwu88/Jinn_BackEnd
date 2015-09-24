<div id="wholeModal">
  <!-- Modal -->
    <div class="panel-heading">
        <h4 class="panel-title">
            <span class="icon-users-outline"></span>
            <label>服务调整</label>
            <span class="pull-right close" ng-click="cancel()">&#x2715</span>
        </h4>
    </div>
        <div class="panel-body">
                <form>                        
                    <div class="modal-left">
                            <!-- 酒店表格 --> 
                            <div class="input-group input-customized">
                                <label>服务名称</label>
                                <input ng-model="serviceInfoDated.CMB_NM"/> 
                            </div>
                            <div class="input-group input-customized">
                                <label>提供商</label>
                                <input ng-model="serviceInfoDated.MRCHNT_NM"/>                                
                            </div>
                            <div class="input-group input-customized">
                                <label>覆盖范围</label>
                                <select ng-model="serviceInfoDated.MRCHNT_CVR"
                                        ng-options="area.name as area.name for area in areacategories">                                                                              
                                </select>  
                            </div>
                            <div class="input-group input-customized">
                                <label>单价</label>
                                <input ng-model="serviceInfoDated.CMB_PRC"/>                                   
                            </div>                                                               
                      
                    </div>
                    <div class="modal-right">                        
                            <!-- 酒店表格 --> 
                            <div class="input-group input-customized">
                                <label>服务类型</label>
                                <select ng-model="serviceInfoDated.MRCHNT_TP"
                                        ng-options="serviceType.SRVC_TP_NM as serviceType.SRVC_TP_NM for serviceType in serviceTypes">                                                                              
                                </select>
                            </div>
                            <div class="input-group input-customized">
                                <label>联系电话</label>
                                <input ng-model="serviceInfoDated.MRCHNT_PHN"/>                                   
                            </div>
                            <div class="input-group input-customized">
                                <label>服务方式</label>
                                <select ng-model="serviceInfoDated.CMB_MTHD"
                                        ng-options="service.option as service.option for service in servicecategories">                                                                              
                                </select>   
                            </div> 
                             <div>
                                <form name="myForm" action="fileupload" class="dropzone" id="my-dropzone" method="post" class = "form single-dropzone" enctype="multipart/form-data">
                                  <br>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <button id="upload-submit" class="btn btn-default margin-t-5"s><i class="fa fa-upload" ></i>上传图片</button>                                                                                                   

                                </form> 

                            </div>                                                                                                                                                          
                    </div> 
                    <div>
                            <div class="input-group input-customized">
                                <label>备注</label>
                                <textarea rows="3" ng-model="serviceInfoDated.CMB_RMRK"/>                                   
                            </div>                        
                    </div> 
                </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-customized" ng-click="update(serviceID,serviceInfoDated)">更新</button>                                          
        </div>
      </div>
      
    </div>
  </div>    