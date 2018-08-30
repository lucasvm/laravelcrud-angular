
require('./bootstrap');

import 'angular';

var LaravelCRUD = angular.module('LaravelCRUD',[]);

LaravelCRUD.controller('CountryController', ['$scope', '$http', function($scope, $http) {

    $scope.tasks = [];

    // List tasks
    $scope.loadCountry = function () {
        $http.get('/country')
            .then(function success(e) {
                $scope.country = e.data.country;
            });
    };
    $scope.loadTasks();

    $scope.errors = [];

    $scope.task = {
        name: '',
        description: ''
    };

    // Open Create-Task modal
    $scope.initAdd = function () {
        $scope.resetForm();
        $('#add_new_country').modal('show');
    };

    // Add new task
    $scope.addCountry = function () {
        $http.post('/country', {
            name: $scope.country.name
        }).then(function success(response) {
            $scope.resetForm();
            $scope.country.push(response.data.country);
            $('#add_new_country').modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    $scope.edit_country = {};

    // Open Edit-Task modal
    $scope.initEdit = function (index) {
        $scope.errors = [];
        $scope.edit_country = $scope.country[index];
        $('#edit_country').modal('show');
    };

    // Update task
    $scope.updateCountry = function () {
        $http.patch('/country/' + $scope.edit_country.id, {
            name: $scope.edit_country.name
        }).then(function success(response) {
            $scope.errors = [];
            $('#edit_country').modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    // Delete task
    $scope.deleteCountry = function (index) {
        let confirm = window.confirm('Do you really want to delete this country?');

        if (confirm) {
            $http.delete('/country/' + $scope.deleteCountry[index].id)
                .then(function success(response) {
                    $scope.deleteCountry.splice(index, 1);
                });
        }
    };

    // Add errors
    $scope.recordErrors = function (error) {
        $scope.errors = [];

        if (error.data.errors.name) {
            $scope.errors.push(error.data.errors.name[0]);
        }

        if (error.data.errors.description) {
            $scope.errors.push(error.data.errors.description[0]);
        }
    };

    // Reset form
    $scope.resetForm = function () {
        $scope.country.name = '';
        $scope.errors = [];
    };
}]);
