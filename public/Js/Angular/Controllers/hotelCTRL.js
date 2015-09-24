/**
 * Created by waylon on 9/8/15.
 */

app.controller('hotelCTRL', function($scope,hotelFactory) {

    /********************************************     validation       ***************************************************/

    $scope.iconAndAction = {"hotelIconAction":util.hotelIconAction};
    /********************************************       utility       ****************************************************/

    $scope.openModal = function(){
        $("#hotelModal").modal({backdrop: true});
    }

    /********************************************      initial function     *****************************************/
    function getHotel(){
        hotelFactory.getHotel().success(function(data){
            $scope.hotels = data;
        });
    };

    function getHotelTypes(){
        hotelFactory.getHotelTypes().success(function(data){
            $scope.hotelTypes = data;
        });
    };
    /********************************************     common initial setting     *****************************************/
    $scope.hotelInfo=null;
    getHotel();
    getHotelTypes();
    setInterval(
        function(){
            getHotel();
            getHotelTypes();               
        }
        ,600000
    );

    /************** ********************************** submit  ********************************** *************/
    $scope.submit = function(hotelInfo){


        var now = dateUtil.tstmpFormat(new Date());

        var hotel = {
            HTL_NM:hotelInfo.HTL_NM,
            HTL_TP:hotelInfo.HTL_TP,
            HTL_PRM_CNTCT_NM:hotelInfo.HTL_PRM_CNTCT_NM,
            HTL_PRM_CNTCT_PHN:hotelInfo.HTL_PRM_CNTCT_PHN,
            HTL_CT:hotelInfo.HTL_CT,
            HTL_ADDRSS:hotelInfo.HTL_ADDRSS, 
            HTL_NM_OF_RM:hotelInfo.HTL_NM_OF_RM,           
            HTL_STATUS:'正常',
            HTL_INPT_TSTMP:now            
        } 

        hotelFactory.postHotelInfo(hotel).success(function(data){
            show(data);
            $("#hotelModal").modal('hide');
        });             
    }
});