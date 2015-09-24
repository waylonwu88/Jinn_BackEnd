app.factory('menuFactory',function($http){
    return{
        getMenu: function(HTL_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getMenu/'+HTL_ID.toString()
            })
        },
        getServiceTypes: function(){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getServiceTypes'
            })
        },
        getPayMethods: function(){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getPayMethods'
            })
        },
        postOrder: function(order,transaction,yunpianInfo){
            return $http({
                method: 'POST',
                headers: {'content-Type':'application/json'},
                url: 'postOrder',
                data: {order:order,transaction:transaction,yunpianInfo:yunpianInfo}
            })
        }
    };
});

app.factory('orderHistoryFactory',function($http){
    return{
        getOrderHistory: function(HTL_ID,ST_TM,END_TM){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getOrderHistory/'+HTL_ID.toString()+'/'+ST_TM+'/'+END_TM
            })
        }
        ,updateStatus: function(order){
            return $http({
                method: 'POST',
                headers: {'content-Type':'application/json'},
                url: 'updateStatus',
                data: {ORDR_ID:order.ORDR_ID,STATUS:order.STATUS}
            })
        }
    };
});

app.factory('orderFactory',function($http){
    return{
        Change2Start: function(ORDR_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'Change2Start/'+ORDR_ID.toString()
            })
        },
        Change2Finish: function(ORDR_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'Change2Finish/'+ORDR_ID.toString()
            })
        },   
        Change2Cancel: function(ORDR_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'Change2Cancel/'+ORDR_ID.toString()
            })
        },                     
        getOrder: function(){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getOrder'
            })
        }        
        ,updateStatus: function(order){
            return $http({
                method: 'POST',
                headers: {'content-Type':'application/json'},
                url: 'updateStatus',
                data: {ORDR_ID:order.ORDR_ID,STATUS:order.STATUS}
            })
        }      
    };
});

app.factory('hotelFactory',function($http){
    return{        
        getHotel: function(){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getHotel'
            })
        }
        ,getHotelTypes: function(){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getHotelTypes'
            })
        } 
        ,postHotelInfo: function(hotelInfo){
            return $http({
                method: 'POST',
                headers: {'content-Type':'application/json'},
                url: 'postHotelInfo',
                data: {hotelInfo:hotelInfo}
            })
        }   
        ,Change2NormalHotel: function(HTL_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'Change2NormalHotel/'+HTL_ID.toString()
            })
        }
        ,Change2PauseHotel: function(HTL_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'Change2PauseHotel/'+HTL_ID.toString()
            })
        }   
        ,Change2StopHotel: function(HTL_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'Change2StopHotel/'+HTL_ID.toString()
            })
        }               
        ,getHotelInfo: function(HTL_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getHotelInfo/'+HTL_ID.toString()
            })
        }
        ,updateHotelInfo: function(hotelID,hotelInfo){
            return $http({
                method: 'POST',
                headers: {'content-Type':'application/json'},
                url: 'updateHotelInfo',
                data: {hotelID:hotelID,hotelInfo:hotelInfo}                
            })
        }        
        ,getServiceRelation: function(HTL_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getServiceRelation/'+HTL_ID.toString()
            })
        }                  
        ,postNewRelation: function(hotelID,relation){
            return $http({
                method: 'POST',
                headers: {'content-Type':'application/json'},
                url: 'postNewRelation',
                data: {hotelID:hotelID,relation:relation}
            })
        }
        ,deleteHotel:function(HTL_ID){
            return $http({
                method: 'GET',
                headers:{'content-Type':'application/json'},
                url:'deleteHotel/'+HTL_ID.toString()
            })
        } 
        ,getAllService:function(){
            return $http({
                method:'GET',
                headers:{'content-Type':'application/json'},
                url:'getAllService'
            })
        }           
    };
});

app.factory('serviceFactory',function($http){
    return{
        Change2NormalService: function(CMB_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'Change2NormalService/'+CMB_ID.toString()
            })
        }
        ,Change2PauseService: function(CMB_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'Change2PauseService/'+CMB_ID.toString()
            })
        }           
        ,getService: function(){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getService'
            })
        }      
        ,getServiceTypes: function(){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getServiceTypeNames'
            })
        }  
        ,postServiceInfo: function(combo,merchant){
            return $http({
                method: 'POST',
                headers: {'content-Type':'application/json'},
                url: 'postServiceInfo',
                data:{combo:combo,merchant:merchant}
            })
        }              
        ,getServiceInfo: function(CMB_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getServiceInfo/'+CMB_ID.toString()
            })
        }
        ,updateServiceInfo: function(serviceID,serviceInfo){
            return $http({
                method: 'POST',
                headers: {'content-Type':'application/json'},
                url: 'updateServiceInfo',
                data:{serviceID:serviceID,serviceInfo:serviceInfo}
            })
        }  
        ,queryMerchant:function(MRCHNT_NM){
            return $http({
                method:'GET',
                headers:{'content-Type':'application/json'},
                url:'queryMerchant/'+MRCHNT_NM.toString()
            })
        }      
        ,getHotelRelation: function(CMB_ID){
            return $http({
                method: 'GET',
                headers: {'content-Type':'application/json'},
                url: 'getHotelRelation/'+CMB_ID.toString()
            })
        }              
        ,postNewRelation: function(serviceID,relation){
            return $http({
                method: 'POST',
                headers: {'content-Type':'application/json'},
                url: 'postServiceNewRelation',
                data: {serviceID:serviceID,relation:relation}
            })
        }
        ,deleteService:function(CMB_ID){
            return $http({
                method: 'GET',
                headers:{'content-Type':'application/json'},
                url:'deleteService/'+CMB_ID.toString()
            })
        }
        ,getAllHotel:function(){
            return $http({
                method:'GET',
                headers:{'content-Type':'application/json'},
                url:'getAllHotel'
            })
        }                               
    };
});