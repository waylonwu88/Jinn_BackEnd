/**
 * Created by Xharlie on 12/18/14.
 */

app.controller('smallMenuController',function ($scope, $http,orderFactory,hotelFactory,serviceFactory,$modal) {
    $scope.excAction = function(actionString){

        /*********************************          订单          **************************************/
        if(actionString == '状态修改'){
            show('待开发');
        }else if(actionString == '已下单'){
            orderFactory.Change2Start($scope.owner.ORDR_ID).success(function(data){
                $scope.owner.STATUS = "已下单";
            });
        }else if(actionString == '已送达'){
            orderFactory.Change2Finish($scope.owner.ORDR_ID).success(function(data){
                $scope.owner.STATUS = "已送达";
            });
        }    
        else if(actionString == '已取消'){
            orderFactory.Change2Cancel($scope.owner.ORDR_ID).success(function(data){
                $scope.owner.STATUS = "已取消";
            });
        }        
        /*********************************          酒店          **************************************/
        else if(actionString == '修改状态'){
            show('待开发');
        }else if(actionString == '正常'){
            hotelFactory.Change2NormalHotel($scope.owner.HTL_ID).success(function(data){
                $scope.owner.HTL_STATUS = "正常";
            });
        }else if(actionString == '暂停服务'){
            hotelFactory.Change2PauseHotel($scope.owner.HTL_ID).success(function(data){
                $scope.owner.HTL_STATUS = "暂停服务";
            });
        }    
        else if(actionString == '协议终止'){
            hotelFactory.Change2StopHotel($scope.owner.HTL_ID).success(function(data){
                $scope.owner.HTL_STATUS = "协议终止";
            });
        }else if(actionString == '调整服务'){
            var hotelID=$scope.owner.HTL_ID
            var modalInstance = $modal.open({
                windowTemplateUrl: 'directiveViews/modalWindowTemplate',
                templateUrl: 'directiveViews/changeHotelRelation',
                controller: 'hotelModalController',
                resolve: {
                    hotelID: function () { 
                        return hotelID;
                    }
                }
            });
        }else if(actionString == '更改信息(酒)'){
            var hotelID=$scope.owner.HTL_ID           
            var modalInstance = $modal.open({
                windowTemplateUrl: 'directiveViews/modalWindowTemplate',
                templateUrl: 'directiveViews/updateHotel',
                controller: 'hotelModalController',
                resolve: {
                    hotelID: function () {
                        return hotelID;
                    }                                  
                }
            });
        }else if(actionString == '删除酒店'){
            var hotelID=$scope.owner.HTL_ID           
            var modalInstance = $modal.open({
                templateUrl: 'directiveViews/deleteHotel',
                controller: 'hotelModalController',
                resolve: {
                    hotelID: function () {
                        return hotelID;
                    }                                  
                }
            });
        }  

        /*********************************          服务          **************************************/
        else if(actionString == '修改状态'){
            show('待开发');
        }else if(actionString == '开通'){
            serviceFactory.Change2NormalService($scope.owner.CMB_ID).success(function(data){
                $scope.owner.CMB_STATUS = "开通";
            });
        }else if(actionString == '服务暂停'){
            serviceFactory.Change2PauseService($scope.owner.CMB_ID).success(function(data){
                $scope.owner.CMB_STATUS = "服务暂停";
            });
        }    
        else if(actionString == '调整酒店'){
            var serviceID=$scope.owner.CMB_ID
            var modalInstance = $modal.open({
                windowTemplateUrl: 'directiveViews/modalWindowTemplate',
                templateUrl: 'directiveViews/changeServiceRelation',
                controller: 'serviceModalController',
                resolve: {
                    serviceID: function () {
                        return serviceID;
                    }
                }
            });
        }else if(actionString == '更改信息(客)'){
            var serviceID=$scope.owner.CMB_ID
            var modalInstance = $modal.open({
                windowTemplateUrl: 'directiveViews/modalWindowTemplate',
                templateUrl: 'directiveViews/updateService',
                controller: 'serviceModalController',
                resolve: {
                    serviceID: function () {
                        return serviceID;
                    }
                }
            });
        }else if(actionString == '删除服务'){
            var serviceID=$scope.owner.CMB_ID
            var modalInstance = $modal.open({
                windowTemplateUrl: 'directiveViews/modalWindowTemplate',
                templateUrl: 'directiveViews/deleteService',
                controller: 'serviceModalController',
                resolve: {
                    serviceID: function () {
                        return serviceID;
                    }
                }
            });
        }    
    }

    $scope.close = function(owner){
        if($scope.$parent.$parent.extraCleaner!= undefined) $scope.$parent.$parent.extraCleaner(owner);  // clean associate affected element
    }
});


