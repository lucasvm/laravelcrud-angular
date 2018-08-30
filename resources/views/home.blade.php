@extends('layouts.app')

@section('content')
<div class="container" ng-controller="CountryController">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary btn-xs pull-right" ng-click="initAdd()">Add</button>
                    Country
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped" ng-if="Countrys.length > 0">
                        <tr>
                            <th>Id.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        <tr ng-repeat="(index, Country) in Countrys">
                            <td>
                                @{{ index + 1 }}
                            </td>
                            <td>@{{ Country.name }}</td>
                            <td>
                                <button class="btn btn-success btn-xs" ng-click="initEdit(index)">Edit</button>
                                <button class="btn btn-danger btn-xs" ng-click="deleteCountry(index)" >Delete</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="add_new_country">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                            class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Create Country</h4>
                </div><!-- /modal-header -->

                <div class="modal-body">
                    <div class="alert alert-danger" ng-if="errors.length > 0">
                        <ul>
                            <li ng-repeat="error in errors">@{{ error }}</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               ng-model="Country.name">
                    </div>
                </div><!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                    <button type="button" ng-click="addCountry()" class="btn btn-primary">Submit</button>
                </div><!-- /modal-footer -->
            </div><!-- /modal-content -->
        </div><!-- /modal-dialog -->
    </div><!-- /modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="edit_country">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h4 class="modal-title">Update Country</h4>
                </div><!-- /modal-header -->

                <div class="modal-body">
                    <div class="alert alert-danger" ng-if="errors.length > 0">
                        <ul>
                            <li ng-repeat="error in errors">@{{ error }}</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               ng-model="edit_Country.name">
                    </div>

                </div><!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                    <button type="button" ng-click="updateCountry()" class="btn btn-primary">Submit</button>
                </div><!-- /modal-footer -->
            </div><!-- /modal-content -->
        </div><!-- /modal-dialog -->
    </div><!-- /modal -->
</div>
@endsection
