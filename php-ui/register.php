<form id="register-form" action="#" method="post" role="form" ng-hide="currentPage!='register'">
    <div class="form-group">
        <input type="text" name="username" ng-model="form.username" id="username" tabindex="1" class="form-control" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="email" name="email" ng-model="form.email" id="email" tabindex="2" class="form-control" placeholder="Email Address">
    </div>
    <div class="form-group">
        <input type="password" name="password" ng-model="form.password" id="password" tabindex="3" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <input type="password" name="confirm-password"  ng-model="form.cpassword" id="confirm-password" tabindex="4" class="form-control" placeholder="Confirm Password">
    </div>
    <div class="form-group">
        <input type="text" name="twitterId"  ng-model="form.twitterId" id="twitterId" tabindex="5" class="form-control" placeholder="Twitter Username">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="button" name="register-submit" ng-click="register()" id="register-submit" tabindex="5" class="form-control btn btn-register" value="Register Now">
            </div>
        </div>
    </div>
</form>