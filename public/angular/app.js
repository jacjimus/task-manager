var app = angular.module('employeeRecords', [] , function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    })
        .constant('API_URL', 'http://localhost:5310/blog/public/');