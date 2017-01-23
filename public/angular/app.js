var app = angular.module('app', [] , function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    })
        .constant('API_URL', 'http://localhost:5310/blog/public/');