app.controller('hotelModalController', function($scope, $http, $modalInstance, hotelFactory,hotelID){


	    /********************************************       utility       ****************************************************/

	    $scope.areacategories = [
		    		{id:1,name:"西安高新区"},
		    		{id:2,name:"西安雁塔区"},
		    		{id:3,name:"西安莲湖区"},
		    		{id:4,name:"西安未央区"}
	    ];

	     $scope.selected = [];
	     $scope.hotelID = hotelID;
	 
	    $scope.cancel = function () {
	        $modalInstance.dismiss('cancel');
	    };	 

	     var updateSelected = function(action,id){
	         if(action == 'add' && $scope.selected.indexOf(id) == -1){
	             $scope.selected.push(id);
	         }
	         if(action == 'remove' && $scope.selected.indexOf(id)!=-1){
	             var idx = $scope.selected.indexOf(id);
	             $scope.selected.splice(idx,1);
	         }
	     }
	 
	     $scope.updateSelection = function($event, id){
	      	 var checkbox = $event.target;
	         var action = (checkbox.checked?'add':'remove');
	         updateSelected(action,id);
	     }
	 
	    $scope.isSelected = function(id){
	        return $scope.selected.indexOf(id)>=0;
	     }	    

	    $scope.openUpdateModal = function(){
	        $("#hotelUpdateModal").modal({backdrop: true});
	    }

	    $scope.openChangeModal = function(){
	        $("#hotelRelationChangeModal").modal({backdrop: true});
	    }
	    /********************************************      initial function     *****************************************/
		var getHotelInfo=function(hotelID){
	        hotelFactory.getHotelInfo(hotelID).success(function(data){
	            $scope.hotelInfoDated = data[0];	          
	        });				
		}

	    function getHotelTypes(){
	        hotelFactory.getHotelTypes().success(function(data){
	            $scope.hotelTypes = data;
	        });
	    };

		var getServiceRelation = function (hotelID) {
	        hotelFactory.getServiceRelation(hotelID).success(function(data){
	            $scope.serviceRelations = data;
	            for (i=0;i<data.length;i++)
	            {
	            	$scope.selected[i]=data[i].CMB_ID;
	            }
	        });					
		}

		var getAllServices = function (){
			hotelFactory.getAllService().success(function(data){
				$scope.allServices=data;
			});
		}

	    /********************************************     common initial setting     *****************************************/
	    $scope.hotelInfo=null;
	    getHotelInfo(hotelID);
	    getHotelTypes();
	    getServiceRelation(hotelID);
	    getAllServices();

	    setInterval(
	        function(){
			    getHotelInfo(hotelID);
	    		getHotelTypes();			    
			    getServiceRelation(hotelID); 
			    getAllServices();              
	        }
	        ,600000
	    );
    /************** ********************************** update  ********************************** *************/
		$scope.update=function(id,hotelInfo){
        	var now = dateUtil.tstmpFormat(new Date());	
        			
	        var hotel = {
	            HTL_NM:hotelInfo.HTL_NM,
	            HTL_TP:hotelInfo.HTL_TP,
	            HTL_PRM_CNTCT_NM:hotelInfo.HTL_PRM_CNTCT_NM,
	            HTL_PRM_CNTCT_PHN:hotelInfo.HTL_PRM_CNTCT_PHN,
	            HTL_CT:hotelInfo.HTL_CT,
	            HTL_ADDRSS:hotelInfo.HTL_ADDRSS, 
	            HTL_NM_OF_RM:hotelInfo.HTL_NM_OF_RM,           
				HTL_UPDT_TSTMP:now	                        
	        } 

	        hotelFactory.updateHotelInfo(id,hotel).success(function(data){
	            show(data);
	             $modalInstance.close();
	        }); 			
		};  

		$scope.change=function(id,selected){

	        hotelFactory.postNewRelation(id,selected).success(function(data){
	            show(data);
	            $modalInstance.close();
	        });
	     };

	     $scope.deleteHotel=function(id){
	     	hotelFactory.deleteHotel(id).success(function(data){
	     		show(data);
	     		$modalInstance.close();
	     	});
	     };
		  		

	}
)