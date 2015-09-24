var app = angular.module('Operationer',['ngRoute','ngAnimate','ui.bootstrap']);
app.config(['$routeProvider',function ($routeProvider){
    $routeProvider
        .when('/menu',
        {
            controller:'menuCTRL',
            templateUrl: '../resources/views/menu/menu.blade.php'
        })
        .when('/orderHistory',
        {
            controller:'orderHistoryCTRL',
            templateUrl: '../resources/views/orderHistory/orderHistory.blade.php'
        })
        .when('/order',
        {
            controller:'orderCTRL',
            templateUrl: '../resources/views/order/order.blade.php'
        }) 
        .when('/hotel',
        {
            controller:'hotelCTRL',
            templateUrl: '../resources/views/hotel/hotel.blade.php'
        })        
        .when('/service',
        {
            controller:'serviceCTRL',
            templateUrl: '../resources/views/service/service.blade.php'
        })        
        .otherwise({redirectTo: '/order'})
    }
]);
