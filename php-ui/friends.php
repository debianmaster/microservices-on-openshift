<form id="login-form" action="#" method="post" role="form" ng-hide="currentPage!='friends'">
<table class="table table-striped">
  <tr><th><center>username</center></th><th><center>email</center></th></tr>
  <tr ng-repeat="friend in friends">
    <td><center>{{ friend.username }}</center></td>
    <td><center>{{ friend.email }}</center></td>
    <td><center><input type=button value="GetTweets" ng-click="getTweets(friend.twitterId)"></input></center></td>
  </tr>
</table>
</form>
