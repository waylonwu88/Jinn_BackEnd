/**
 * Created by waylon on 9/8/15.
 */

app.controller('orderCTRL', function($scope,orderFactory) {

    /********************************************     validation       ***************************************************/

    /********************************************       utility       ****************************************************/

    $scope.iconAndAction = {"orderIconAction":util.orderIconAction};
    $scope.selectServiceType = function(serviceType,serviceTypeStyel){
        $scope.selectedType = serviceType;
        serviceActive.activeClass = '';
        serviceTypeStyel.activeClass = 'btn-active';
        serviceActive = serviceTypeStyel;
    }

    $scope.openModal = function(combo,id){
        $scope.cmbSelected = JSON.parse(JSON.stringify(combo));
        $scope.cmbSelected.AMNT = 1;
        if($scope.cmbSelected.payMethods == null){
            $scope.cmbSelected.payMethods = [];
            var payMethodArray = $scope.cmbSelected.CMB_PAY_MTHD.split(',');
            for(var i = 0; i < $scope.payMethods.length; i++){
                if(payMethodArray.indexOf($scope.payMethods[i].PAY_MTHD_ID.toString())>=0){
                    $scope.cmbSelected.payMethods.push($scope.payMethods[i]);
                }
            }
        }
        $scope.cmbSelected.PYMNT_MTHD = $scope.cmbSelected.payMethods[0].PAY_MTHD_NM;
        $('#'+id).modal({backdrop: true});
    }

    /********************************************      initial function     *****************************************/
    function getOrder(){
        orderFactory.getOrder().success(function(data){
            $scope.orders = data;
        });
    };


    /********************************************     common initial setting     *****************************************/
    getOrder();
    setInterval(
        function(){
            getOrder();
        }
        ,600000
    );

});