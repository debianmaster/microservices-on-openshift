<!DOCTYPE html>
<html lang="en">
<?php
 include 'head.php';
?>
<body ng-app="myApp">
    <div class="container" ng-controller="appController">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#" ng-class="currentPage=='login'?'active':'';" id="login-form-link" ng-click="currentPage='login'">Login</a>
                            </div>
                            <div class="col-xs-3">
                                <a href="#" ng-class="currentPage=='register'?'active':'';"  id="register-form-link" ng-click="currentPage='register'">Register</a>
                            </div>
                            <div class="col-xs-3">
                                <a href="#" ng-class="currentPage=='friends'?'active':'';" id="friends-form-link" ng-click="currentPage='friends'">Friends List</a>
                            </div>
                            <div class="col-xs-3">
                                <a href="#" ng-class="currentPage=='tweets'?'active':'';" id="tweets-form-link" ng-click="currentPage='tweets'">Tweets</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <input type=hidden id="hdnUserRegSvc" value="<?= getenv('USER_REG_SVC'); ?>">
                        <input type=hidden id="hdnTwitterSvc" value="<?= getenv('TWITTER_FEED_SVC'); ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                 include 'login.php';
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            <?php
                             include 'register.php';
                            ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            <?php
                             include 'friends.php';
                            ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            <?php
                             include 'tweets.php';
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body>

</html>
