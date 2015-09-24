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
                                <label>酒店名称</label>
                                <input ng-model="hotelInfoDated.HTL_NM"/> 
                            </div>
                            <div class="input-group input-customized">
                                <label>联系人</label>
                                <input ng-model="hotelInfoDated.HTL_PRM_CNTCT_NM"/>                                
                            </div>
                            <div class="input-group input-customized">
                                <label>城市</label>
                                <input ng-model="hotelInfoDated.HTL_CT"/>   
                            </div>
                            <div class="input-group input-customized">
                                <label>房间数</label>
                                <input ng-model="hotelInfoDated.HTL_NM_OF_RM"/>                                   
                            </div>                                                               
                      
                    </div>
                    <div class="modal-right">                        
                            <!-- 酒店表格 --> 
                            <div class="input-group input-customized">
                                <label>酒店类型</label>
                                <select ng-model="hotelInfoDated.HTL_TP"
                                        ng-options="hotelType.HTL_TP_NM as hotelType.HTL_TP_NM for hotelType in hotelTypes ">                                       
                                </select>
                            </div>
                            <div class="input-group input-customized">
                                <label>联系电话</label>
                                <input ng-model="hotelInfoDated.HTL_PRM_CNTCT_PHN"/>                                   
                            </div>
                            <div class="input-group input-customized">
                                <label>地址</label>
                                <input ng-model="hotelInfoDated.HTL_ADDRSS"/>    
                            </div>                                                                                                 
                    </div>  
                </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-customized" ng-click="update(hotelID,hotelInfoDated)">更新</button>                                          
        </div>
      </div>
      
    </div>
  </div>    