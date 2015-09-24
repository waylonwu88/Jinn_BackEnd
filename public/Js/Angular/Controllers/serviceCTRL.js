/**
 * Created by waylon on 9/8/15.
 */

app.controller('serviceCTRL', function($scope,serviceFactory) {

    /********************************************     validation       ***************************************************/

    /********************************************       utility       ****************************************************/
    var fileName=null;

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

    $scope.iconAndAction = {"serviceIconAction":util.serviceIconAction};
    
    $scope.openModal = function(){
        $("#serviceModal").modal({backdrop: true});
    }

    /********************************************      initial function     *****************************************/

    function getService(){
        serviceFactory.getService().success(function(data){
            $scope.services = data;
        });
    };

    function getServiceTypes(){
        serviceFactory.getServiceTypes().success(function(data){
            $scope.serviceTypes = data;
        });
    };

    /********************************************     common initial setting     *****************************************/
    $scope.serviceInfo=null;
    getService();
    getServiceTypes();
    setInterval(
        function(){
            getService();
            getServiceTypes();            
        }
        ,600000
    );

    /************** ********************************** submit  ********************************** *************/
    $scope.submit = function(serviceInfo,merchantInfo){


        var now = dateUtil.tstmpFormat(new Date());

        var combo = {
            CMB_NM:serviceInfo.CMB_NM,
            CMB_MTHD:serviceInfo.CMB_MTHD, 
            CMB_PRC:serviceInfo.CMB_PRC,
            CMB_RMRK:serviceInfo.CMB_RMRK,           
            CMB_STATUS:'开通',
            CMB_INPT_TSTMP:now,  
            CMB_PIC:fileName        
        } 

        var merchant={
            MRCHNT_NM:merchantInfo.MRCHNT_NM,
            MRCHNT_PHN:merchantInfo.MRCHNT_PHN,
            MRCHNT_CVR:merchantInfo.MRCHNT_CVR,
            MRCHNT_TP:merchantInfo.MRCHNT_TP            
        }
        show(fileName);
        if (fileName!=null)
        {
            serviceFactory.postServiceInfo(combo,merchant).success(function(data){
                show(data);
                $("#serviceModal").modal('hide');
            });             
        }
            
    };

     $scope.queryInfo=function(merchantName){
        serviceFactory.queryMerchant(merchantName).success(function(data){
            show(data);
            $scope.merchantInfo = data[0];
        });
     };

     $scope.uploadPic=function(uploadPic){
        show('guess');
     };    


    $(document).ready(function() {
     
             var date = new Date();
      //Dropzone.js Options - Upload an image via AJAX.
      Dropzone.options.myDropzone = {
         url: "fileupload",

        uploadMultiple: false,
        // previewTemplate: '',
        addRemoveLinks: false,
        // maxFiles: 1,
        dictDefaultMessage: '',

        acceptedFiles: "image/*",

        headers: {
            'X-CSRF-Token': $('meta[name="token"]').attr('content')
        },


        sending: function(file, xhr, formData) {
            // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
            formData.append("_token", $('[name=_token]').val()); // Laravel expect the token post value to be named _token by default
        },

        uploadprogress: function(progress, bytesSent) {
            console.log(progress);
        },

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

      var myDropzone = new Dropzone("#my-dropzone");
     
      $('#upload-submit').on('click', function(e) {
        e.preventDefault();
        //trigger file upload select
        $("#my-dropzone").trigger('click');
      });
     
    });
     
    //we want to manually init the dropzone.
    Dropzone.autoDiscover = false;     
});