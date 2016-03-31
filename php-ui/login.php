<form id="login-form" action="#" method="post" role="form" ng-hide="currentPage!='login'">
    <div class="form-group">
        <input type="text" ng-model="loginform.username" name="username" id="login-username" tabindex="1" class="form-control" placeholder="Username" value="">
    </div>
    <div class="form-group">
        <input type="password" ng-model="loginform.password" name="password" id="login-password" tabindex="2" class="form-control" placeholder="Password">
    </div>
    <div class="form-group text-center">
        <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
        <label for="remember"> Remember Me</label>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="button" ng-click="login()" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
            </div>
        </div>
    </div>
    <span ng-show="token">
        Auth Token:
        <div class="form-group">
            <input type="text" ng-model="token" name="token" id="token" tabindex="4" class="form-control" placeholder="Auth Token">
        </div>    
        <div class="form-group">
            <input type="button" ng-click="getFriendsList()"  class="form-control btn btn-login" value="Get Friends List">
        </div>
    </span>
</form>