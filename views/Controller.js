(function (angular) {
    'use strict'
    angular.module("MyController", [])
        .controller("HomeController", function ($scope, $http) {

        })

        //controller periode
        .controller("PeriodeController", function ($scope, $http) {
            $scope.DatasPeriode = [];
            $scope.input = {};
            $scope.status = "Simpan";
            $http({
                method: "get",
                url: "http://localhost/kuis/restapi/CodeIgniter/Periode",
                header: {
                    "Content-Type": "application/json"
                }
            }).then(function (response) {
                $scope.DatasPeriode = response.data.data;
            }, function (error) {
                alert(error.message);
            })

            $scope.Simpan = function () {
                if ($scope.status == "Simpan") {
                    $http({
                        method: "POST",
                        url: "http://localhost/kuis/restapi/CodeIgniter/Periode",
                        data: $scope.input,
                        header: {
                            "Content-Type": "application/json"
                        }
                    }).then(function (response) {
                        $scope.DatasPeriode.push(angular.copy($scope.input));
                        alert("Data berhasil disimpan...");
                    }, function (error) {
                        alert("Data gagal disimpan...");
                    })
                } else {
                    $http({
                        method: "PUT",
                        url: "http://localhost/kuis/restapi/CodeIgniter/Periode",
                        data: $scope.input,
                        header: {
                            "Content-Type": "application/json"
                        }
                    }).then(function (response) {
                        alert("Data berhasil diubah");
                    }, function (error) {
                        alert("Data gagal diubah");
                    })
                }
            }
            $scope.Hapus = function (item) {
                $http({
                    method: "DELETE",
                    url: "http://localhost/kuis/restapi/CodeIgniter/Periode?id_Periode=" + item.id_Periode,
                }).then(function (response) {
                    var index = $scope.DatasPeriode.indexOf(item);
                    $scope.DatasPeriode.splice(index, 1);
                    alert("Data Berhasil Dihapus");
                    $scope.DatasPeriode.push($scope.input);
                }, function(error){
                    alert("Data Gagal Dihapus");
                })
            }

            $scope.GetData = function(item){
                $scope.input = item;
                $scope.status = "Update";
            }
            $scope.GetSimpan = function(item){
                $scope.status = "Simpan";
            }
        })

        //controller user
        .controller("UserController", function ($scope, $http) {
            $scope.DatasUser = [];
            $scope.input = {};
            $scope.status = "Simpan";
            $http({
                method: "get",
                url: "http://localhost/kuis/restapi/CodeIgniter/User",
                header: {
                    "Content-Type": "application/json"
                }
            }).then(function (response) {
                $scope.DatasUser = response.data.data;
            }, function (error) {
                alert(error.message);
            })

            $scope.Simpan = function () {
                if ($scope.status == "Simpan") {
                    $http({
                        method: "POST",
                        url: "http://localhost/kuis/restapi/CodeIgniter/User",
                        data: $scope.input,
                        header: {
                            "Content-Type": "application/json"
                        }
                    }).then(function (response) {
                        $scope.DatasUser.push(angular.copy($scope.input));
                        alert("Data berhasil disimpan...");
                    }, function (error) {
                        alert("Data gagal disimpan...");
                    })
                } else {
                    $http({
                        method: "PUT",
                        url: "http://localhost/kuis/restapi/CodeIgniter/User",
                        data: $scope.input,
                        header: {
                            "Content-Type": "application/json"
                        }
                    }).then(function (response) {
                        alert("Data berhasil diubah");
                    }, function (error) {
                        alert("Data gagal diubah");
                    })
                }
            }
            $scope.Hapus = function (item) {
                $http({
                    method: "DELETE",
                    url: "http://localhost/kuis/restapi/CodeIgniter/User?id_User=" + item.id_User,
                }).then(function (response) {
                    var index = $scope.DatasPeriode.indexOf(item);
                    $scope.DatasUser.splice(index, 1);
                    alert("Data Berhasil Dihapus");
                    $scope.DatasUser.push($scope.input);
                }, function(error){
                    alert("Data Gagal Dihapus");
                })
            }

            $scope.GetData = function(item){
                $scope.input = item;
                $scope.status = "Update";
            }
            $scope.GetSimpan = function(item){
                $scope.status = "Simpan";
            }
        })


        .controller("UserController", function ($scope, $http) {
            $scope.DatasRole = [];
            $http({
                method: "get",
                url: "http://localhost/kuis/restapi/CodeIgniter/User",
                header: {
                    "Content-Type": "application/json"
                }
            }).then(function (response) {
                $scope.DatasRole = response.data.data;
            }, function (error) {
                alert(error.message);
            })
        })

        .controller("SoalController", function ($scope, $http) {
            $scope.DatasSoal = [];
            $http({
                method: "get",
                url: "http://localhost/kuis/restapi/CodeIgniter/Soal",
                header: {
                    "Content-Type": "application/json"
                }
            }).then(function (response) {
                $scope.DatasSoal = response.data.data;
            }, function (error) {
                alert(error.message);
            })
        })

        .controller("JawabanController", function ($scope, $http) {
            $scope.DatasJawaban = [];
            $http({
                method: "get",
                url: "http://localhost/kuis/restapi/CodeIgniter/Jawaban",
                header: {
                    "Content-Type": "application/json"
                }
            }).then(function (response) {
                $scope.DatasJawaban = response.data.data;
            }, function (error) {
                alert(error.message);
            })
        })
})(window.angular);