'use strict';

var app = angular.module("kmSim", ['ngRoute', 'ui.bootstrap', 'textAngular', 'ngTagsInput', ]);

app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
        when('/simulado', {
            templateUrl: 'simulados.html',
            controller: 'RouteController'
        }).
        when('/perguntas/', {
            templateUrl: 'perguntas.html',
            controller: 'RouteController'
        }).
        when('/instituicao/', {
            templateUrl: 'instituicao.html',
            controller: 'RouteController'
        }).
        when('/materia/', {
            templateUrl: 'materia.html',
            controller: 'RouteController'
        }).
        when('/topico/', {
            templateUrl: 'topico.html',
            controller: 'RouteController'
        }).
        when('/recursos/', {
            templateUrl: 'recursos.html',
            controller: 'RouteController'
        }).
        when('/tags/', {
            templateUrl: 'tags.html',
            controller: 'RouteController'
        }).
        when('/', {
            templateUrl: 'home.html',
            controller: 'RouteController'
        }).
        otherwise({
            redirectTo: '/'
        });
    }
]);

app.controller("RouteController", function ($scope, $routeParams) {
    $scope.param = $routeParams.param;
});

app.controller("GravatarCtrl", function ($scope) {
    $scope.image = "http://www.gravatar.com/avatar/$0.png".format(kmApi.hash.md5('carlos.caimi@gmail.com'));
});

app.controller("SimuladoCtrl", function ($scope, $http) {
    $http.jsonp('http://localhost/rest/portfolios').success(function (data) {
        $scope.port = data;
        console.log("deveria trazer dados");
    });

});

app.controller("PerguntaCtrl", function ($scope, $http) {
    $scope.tags = [];
    $scope.alternativas = [];

    $http.get('/kmsim/rest/tagsByTipo/materia').success(function (data) {
        $scope.materias = data;
    });
    $http.get('/kmsim/rest/tagsByTipo/topico').success(function (data) {
        $scope.topicos = data;
    });
    $http.get('/kmsim/rest/tagsByTipo/instituicao').success(function (data) {
        $scope.instituicoes = data;
    });
    $http.get('/kmsim/rest/tagsByTipo/grau').success(function (data) {
        $scope.graus = data;
    });
    $scope.loadTags = function ($q) {
        return $http.get('/kmsim/rest/tagsSearch/' + $q + '/topico');
    };

    $scope.submit = function () {
        console.log("[$0]-[$1]-[$2]-[$3]-[$4]".format($scope.pergunta.materia, $scope.pergunta.topicos, $scope.pergunta.instituicao, $scope.pergunta.grau, $scope.pergunta.enunciado) );
    }
});

app.controller("FileCtrl", function ($scope, $http) {
    $scope.add = function () {
        var f = document.getElementById('file').files[0],
            r = new FileReader();
        r.onloadend = function (e) {
            var data = e.target.result;
            //send you binary data via $http or $resource or do anything else with it
        }
        r.readAsBinaryString(f);
        alert(r)
    }
});

app.controller("TagsCtrl", function ($scope, $http, $location) {
    var actived = $location.search().active;
    $scope.tabs = [{
        title: 'Matérias',
        content: 'materia.html',
        active: actived == 'materia'
    }, {
        title: 'Tópicos',
        content: 'topico.html',
        active: actived == 'topico'
    }, {
        title: 'Instituições',
        content: 'instituicao.html',
        active: actived == 'instituicao'
    }, {
        title: 'Grau de Escolaridade',
        content: 'grau.html',
        active: actived == 'grau'
    }];

    $http.get('/kmsim/rest/tagsByTipo/instituicao').success(function (data) {
        $scope.instituicoes = data;
    });
    $http.get('/kmsim/rest/tagsByTipo/materia').success(function (data) {
        $scope.materias = data;
    });

    $http.get('/kmsim/rest/tagsByTipo/topico').success(function (data) {
        $scope.topicos = data;
    });
    $http.get('/kmsim/rest/tagsByTipo/grau').success(function (data) {
        $scope.graus = data;
    });

    $scope.submit = function () {
        var enviar = confirm("Os dados seram enviados. Confirma?");

        if (enviar) {
            var data = {
                "nome": $scope.tag.nome,
                "tipo": $scope.tag.tipo
            };

            $http.post('/kmsim/rest/tag', data).success(function (retorno) {
                $location.path('tags');
                $location.search({
                    active: data.tipo
                });
            });
        }
        //console.log('model' + $scope.instituicao.nome+"-"+$scope.instituicao.tipo);
    }

    $scope.deleteTag = function (tag) {
        var enviar = confirm("$0 será removida. Confirma?".format(tag.nome));
        if (enviar) {
            $http.delete('/kmsim/rest/tag/$0'.format(tag.id)).success(function () {
                $location.path('tags');
                $location.search({
                    active: tag.tipo
                });
            });
        }
    }
});