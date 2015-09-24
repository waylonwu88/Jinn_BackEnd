app.controller('serviceModalController', function($scope, $http, $modalInstance, serviceFactory,serviceID){


	    /********************************************       utility       ****************************************************/

	    $scope.areacategories = [
		    		{id:1,name:"西安高新区"},
		    		{id:2,name:"西安雁塔区"},
		    		{id:3,name:"西安莲湖区"},
		    		{id:4,name:"西安未央区"}
	    ];

	     $scope.servicecategories=[
	     		{id:1,option:"上门服务"},
	     		{id:2,option:"快递取件"}
	     ];
	     $scope.selected = [];
	     $scope.serviceID = serviceID;
	 
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

	    /********************************************      initial function     *****************************************/
	    var fileName=null;
		var getServiceInfo=function(serviceID){
	        serviceFactory.getServiceInfo(serviceID).success(function(data){
	            $scope.serviceInfoDated = data[0];         
	        });				
		}

	    function getServiceTypes(){
	        serviceFactory.getServiceTypes().success(function(data){
	            $scope.serviceTypes = data;
	        });
	    };

		var getHotelRelation = function (serviceID) {
	        serviceFactory.getHotelRelation(serviceID).success(function(data){
	            $scope.hotelRelations = data;
	            for (i=0;i<data.length;i++)
	            {
	            	$scope.selected[i]=data[i].HTL_ID;
	            }
	        });					
		}

		var getAllHotel = function (){
			serviceFactory.getAllHotel().success(function(data){
				$scope.allhotels=data;
			});
		}
	    /********************************************     common initial setting     *****************************************/
	    $scope.serviceInfoDated=null;
	    getServiceInfo(serviceID);
	    getServiceTypes();
		getAllHotel();	    
	    getHotelRelation(serviceID);

	    setInterval(
	        function(){
			    getServiceInfo(serviceID);
			    getServiceTypes();
			    getAllHotel();
			    getHotelRelation(serviceID);             
	        }
	        ,600000
	    );
    /************** ********************************** update  ********************************** *************/
		$scope.update=function(id,serviceInfoDated){
        	var now = dateUtil.tstmpFormat(new Date());	
        			
	        var service = {
	            CMB_NM:serviceInfoDated.CMB_NM,
	            MRCHNT_TP:serviceInfoDated.MRCHNT_TP,
	            MRCHNT_NM:serviceInfoDated.MRCHNT_NM,
	            MRCHNT_PHN:serviceInfoDated.MRCHNT_PHN,
	            MRCHNT_CVR:serviceInfoDated.MRCHNT_CVR,
	            CMB_MTHD:serviceInfoDated.CMB_MTHD, 
	            CMB_PRC:serviceInfoDated.CMB_PRC,  
	            CMB_RMRK:serviceInfoDated.CMB_RMRK,         
				CMB_UPDT_TSTMP:now,	                        
            	CMB_PIC:fileName  				
	        } 

	        serviceFactory.updateServiceInfo(id,service).success(function(data){
	             $modalInstance.close();
	        }); 			
		};  

		$scope.change=function(id,selected){
	        serviceFactory.postNewRelation(id,selected).success(function(data){
	            $modalInstance.close();
	        });
	     };

	     $scope.deleteService=function(id){
	     	serviceFactory.deleteService(id).success(function(data){
	     		show(data);
	     		$modalInstance.close();
	     	});
	     };

		$(document).ready(function() {
		 
		  //Dropzone.js Options - Upload an image via AJAX.
		  Dropzone.options.myDropzone = {
		    uploadMultiple: false,
		    // previewTemplate: '',
		    addRemoveLinks: false,
		    // maxFiles: 1,
		    dictDefaultMessage: '',
		    init: function() {
		      this.on("addedfile", function(file) {
		        // console.log('addedfile...');
		      });
		      this.on("thumbnail", function(file, dataUrl) {
		        // console.log('thumbnail...');
		        $('.dz-image-preview').hide();
		        $('.dz-file-preview').hide();
		      });
		      this.on("success", function(file, res) {
		        console.log('upload success...');
		        $('#img-thumb').attr('src', res.path);
		        $('input[name="pic_url"]').val(res.path);
            	fileName=file.name;		        
		      });
		    }
		  };
		  var myDropzone = new Dropzone("div#my-dropzone");
		 
		  $('#upload-submit').on('click', function(e) {
		    e.preventDefault();
		    //trigger file upload select
		    $("#my-dropzone").trigger('click');
		  });
		 
		});
		 
		//we want to manually init the dropzone.
		Dropzone.autoDiscover = false;	     
	
	}
)