(function (angular) {
    'use strict'
    angular.module("MyApp", ["MyController", "ngAnimate", "ui.router"])
        .config(function ($stateProvider, $urlRouterProvider) {
            $urlRouterProvider.otherwise("Home");
            $stateProvider
                .state("Home", {
                    url: "/Home",
                    templateUrl: "views/pages/Home.html",
                    controller: "HomeController"
                })
                .state("Periode", {
                    url: "/Periode",
                    templateUrl: "views/pages/Periode.html",
                    controller: "PeriodeController"
                })
                .state("Role", {
                    url: "/Role",
                    templateUrl: "views/pages/Role.html",
                    controller: "RoleController"
                })
                .state("User", {
                    url: "/User",
                    templateUrl: "views/pages/User.html",
                    controller: "UserController"
                })
                .state("Soal", {
                    url: "/Soal",
                    templateUrl: "views/pages/Soal.html",
                    controller: "SoalController"
                })
                .state("Jawaban", {
                    url: "/Jawaban",
                    templateUrl: "views/pages/Jawaban.html",
                    controller: "JawabanController"
                });
        })
})(window.angular);
