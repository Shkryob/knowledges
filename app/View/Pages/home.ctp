<html>
    <head>
        <title>Homework.in.ua</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body data-ng-app="UserManager" data-ng-controller="MainController">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="#">{{'Homework.in.ua' | translate}}</a>
                <button
                    type="button"
                    class="navbar-toggle btn-success"
                    ng-init="isCollapsed = true"
                    ng-click="isCollapsed = !isCollapsed">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header navbar-collapse" ng-class="{collapse: isCollapsed}">
                    
                    <ul class="nav navbar-nav">
                        <li data-ng-class="{'active': path=='/roles/'}"
                            data-ng-if="currentUser.role == 'Admin'">
                            <a href="#/roles/">{{'Roles' | translate}}</a>
                        </li>
                        <li data-ng-class="{'active': path=='/users/'}"
                            data-ng-if="currentUser.role == 'Admin' || currentUser.role == 'Teacher'">
                            <a href="#/users/">{{'Users' | translate}}</a>
                        </li>
                        <li data-ng-class="{'active': path=='/lessons/'}"
                            data-ng-if="currentUser.role == 'Admin' || currentUser.role == 'Teacher'">
                            <a href="#/lessons/">{{'Lessons' | translate}}</a>
                        </li>
                        <li data-ng-class="{'active': path=='/groups/'}"
                            data-ng-if="currentUser.role == 'Admin' || currentUser.role == 'Teacher'">
                            <a href="#/groups/">{{'Groups' | translate}}</a>
                        </li>
                        <li data-ng-class="{'active': path=='/answer/'}"
                            data-ng-if="currentUser.role == 'Pupil'">
                            <a href="#/answer/">{{'Lessons' | translate}}</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-form navbar-right navbar-collapse" ng-class="{collapse: isCollapsed}">
                    <div class="btn-group">
                        <label  data-ng-repeat="lang in languages"
                                data-ng-click="changeLanguage(lang.key)"
                                data-ng-class='{"Left": $first, "Right": $last, "Middle": $middle}'
                                class="btn btn-success"
                                uncheckable>
                            {{lang.name}}
                        </label>
                    </div>
                    <a href="#/login/"
                       class="btn btn-success"
                       data-ng-if="!isLoggedIn()">{{'Sign in' | translate}}</a>
                    <a href="#/register/"
                       class="btn btn-success"
                       data-ng-if="!isLoggedIn()">{{'Register' | translate}}</a>

                    <a href="#"
                       class="btn btn-danger"
                       data-ng-click="logout($event)"
                       data-ng-if="isLoggedIn()">{{'Logout' | translate}}</a>
                </div>
            </div>
        </nav>


        <div class="container">
            <div class="row">
                <div class="alerts-wrap">
                    <alert ng-repeat="alert in alerts"
                           type="{{alert.type}}"
                           close="closeAlert($index)">{{alert.message | translate}}</alert>
                </div>
                <div class="col-md-12" ng-view>

                </div>
            </div>
            <hr>

            <footer>
                <p>&copy; <a href="mailto:shkryob@ya.ru">Kostya Shkryob</a></p>
            </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-animate.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-resource.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-route.js"></script>
        <script src="js/vendor/ui-bootstrap-tpls-0.12.0.min.js"></script>
        <script src="http://code.angularjs.org/1.0.8/i18n/angular-locale_ru-ru.js"></script>
        <script src="js/vendor/angular-translate.min.js"></script>
        <script src="js/vendor/angular-translate-loader-static-files.min.js"></script>
        <script src="js/vendor/angular-file-upload-shim.min.js"></script>
        <script src="js/vendor/angular-file-upload.min.js"></script>
        <script src="js/vendor/ng-ckeditor.min.js"></script>
        <script src="js/vendor/ckeditor/ckeditor.js"></script>

        <script src="js/app/app.js"></script>

        <script src="js/app/resources/RolesResource.js"></script>
        <script src="js/app/resources/UsersResource.js"></script>
        <script src="js/app/resources/LessonsResource.js"></script>
        <script src="js/app/resources/GroupsResource.js"></script>
        <script src="js/app/resources/AnswersResource.js"></script>
        
        <script src="js/app/controllers/roles/ListController.js"></script>
        <script src="js/app/controllers/roles/EditController.js"></script>
        <script src="js/app/controllers/roles/AddController.js"></script>

        <script src="js/app/controllers/MainContoller.js"></script>
        <script src="js/app/controllers/users/RegisterController.js"></script>
        <script src="js/app/controllers/users/LoginController.js"></script>
        <script src="js/app/controllers/users/ListController.js"></script>
        <script src="js/app/controllers/users/EditController.js"></script>

        <script src="js/app/controllers/groups/ListController.js"></script>
        <script src="js/app/controllers/groups/EditController.js"></script>
        <script src="js/app/controllers/groups/AddController.js"></script>
        
        <script src="js/app/controllers/lessons/ListController.js"></script>
        <script src="js/app/controllers/lessons/EditController.js"></script>
        <script src="js/app/controllers/lessons/AddController.js"></script>
        <script src="js/app/controllers/lessons/EvaluateController.js"></script>
        
        <script src="js/app/controllers/answers/ListController.js"></script>
        <script src="js/app/controllers/answers/EditController.js"></script>
        
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter27824376 = new Ya.Metrika({id:27824376,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/27824376" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    </body>
</html>
