var app = angular.module('app', [] , function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
       //  $interpolateProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|chrome-extension):/);
    })
        .constant('API_URL', 'http://localhost:5310/blog/public/');