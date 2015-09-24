<!DOCTYPE html>
<html ng-app="Operationer" >
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-COMPATIBLE" content="IE-edge">
        <title>神灯后台</title>
        <link href="css/app.css" rel="stylesheet">
         <link href="css/additional.css" rel="stylesheet">
        <!-- Javascript -->
        <!--        <script src="assets/javascripts/application.js"></script>-->
    </head>
    <body>
        <div class="sideNavContainer" ng-controller="generalNavCTRL" >
            @include('generalNav')
        </div>
        <div class="main contentContainer container-fluid "  ng-view></div>

        <!-- JS lib-->

        <script src="Scripts/Jquery/jquery-1.11.1.js"></script>
        <script src="Scripts/BootStrap/bootstrap.min.js"></script>
        <script src="Scripts/AngularJs/angular_1.4.1/angular.min.js"></script>
        <script src="Scripts/AngularJs/angular_1.4.1/ui-bootstrap-tpls.min.js"></script>
        <script src="Scripts/AngularJs/angular_1.4.1/angular-route.min.js"></script>
        <script src="Scripts/AngularJs/angular_1.4.1/angular-animate.min.js"></script>
        <script src="Scripts/AngularJs/angular_1.4.1/angular-cookies.min.js"></script>
        <script src="Scripts/AngularJs/angular_1.4.1/angular-locale_zh-cn.js"></script>
        <!-- JS dropzone module -->
        <script src="Scripts/dropzone.js"></script>        
        <!--JS upload -->
        <script src="Scripts/ng-file-upload-bower-7.2.1/ng-file-upload-shim.min.js"></script>
        <script src="Scripts/ng-file-upload-bower-7.2.1/ng-file-upload.min.js"></script>
        <script src="Scripts/ng-file-upload-bower-7.2.1/ng-file-upload-all.min.js"></script>
        <script src="Scripts/ng-file-upload-bower-7.2.1/FileAPI.min.js"></script>
        <script src="JS/Angular/Controllers/uploadCTRL.js"></script>

        <!-- JS Angular module-->
        <script src="Js/Angular/module.js"></script>
        <!-- JS Angular Controllers-->
        <script src="Js/Angular/Controllers/buildInDirController.js"></script>
        <script src="Js/Angular/Controllers/generalNavCTRL.js"></script>
        <script src="Js/Angular/Controllers/menuCTRL.js"></script>
        <script src="Js/Angular/Controllers/orderHistoryCTRL.js"></script>
        <script src="Js/Angular/Controllers/orderCTRL.js"></script>
        <script src="Js/Angular/Controllers/hotelCTRL.js"></script>
        <script src="Js/Angular/Controllers/serviceCTRL.js"></script>
        <!-- JS Angular Services-->
        <script src="Js/Angular/Services/menuService.js"></script>

        <!-- JS utility-->
        <script src="Js/pan_lib/dateUtil.js"></script>
        <script src="Js/pan_lib/filter.js"></script>
        <script src="Js/pan_lib/util.js"></script>
        <!--JS popmenu-->
        <script src="Js/Angular/directives/popMenu.js"></script>
        <script src="Js/Angular/Controllers/menu/smallMenuController.js"></script>  
        <script src="Js/Angular/Controllers/hotelModalController.js"></script>   
        <script src="Js/Angular/Controllers/serviceModalController.js"></script>          
    </body>
</html>

