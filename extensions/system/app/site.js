angular.module('site', ['Application', 'ngResource'])

    .value('name', 'site')

    .value('UIkit', jQuery.UIkit)

    .factory('Node', ['$resource', 'Application', function($resource, App) {
        return $resource(App.url('/:id'), {}, {
            query: { method: 'GET', responseType: 'json' }
        });
    }])

    .filter('truthy', ['$filter', function($filter) {
        return function(collection) {
            return $filter('toArray')(collection).filter(function(value) {
                return !!value;
            });
        };
    }]);