<form id="login-form" action="#" method="post" role="form" ng-hide="currentPage!='friends'">
<table class="table table-striped">
  <tr><th><center>username</center></th><th><center>email</center></th></tr>
  <tr ng-repeat="tweet in tweets">
    <td><center>{{tweet | json }}</center></td>
  </tr>
</table>
</form>
