<form id="login-form" action="#" method="post" role="form" ng-hide="currentPage!='tweets'">
<table class="table table-striped">
  <tr ng-repeat="tweet in tweets">
    <td><center>{{tweet | json }}</center></td>
  </tr>
</table>
</form>
