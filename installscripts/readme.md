# Quick Install Scripts

If you want to quickly deploy these microservices independently without using  templates, you can use the following scripts.

Once you clone the repository, navigate to `installscripts` folder. Run the scripts in order.

[1.setVariable.sh](1.setVariable.sh) This script sets all the environment variables needed by your services. Edit this script first.
	
* Create a project to deploy microservices (`oc new-project mstest`) and use the same projectName (example `mstest`) as the value for three variables `OSE_CLIENT_PROJECT`, `OSE_SERVICES_PROJECT` and `OSE_INFRA_PROJECT`. For more complex deployments where you want to separate this application into distinct projects these variables may gave separate values. 
*  `OSE_DOMAIN` is the domain name or the wildcard DNS for your openshift setup. 
*  `FROM_GMAIL` and `FROM_GMAIL_PASSWORD` are the values for the gmail account to use by the email service. Email service requires a gmail account to use to send emails from. So create an email account and add the values for these variables.
*  `TWITTER_CONSUMER_KEY`, `TWITTER_CONSUMER_SECRET`, `TWITTER_OAUTH_ACCESS_TOKEN`, `TWITTER_OAUTH_ACCESS_TOKEN_SECRET` are the credentials required by the Twitter service to pull the tweets. Refer the documentation here [https://dev.twitter.com/oauth/overview/application-owner-access-tokens](https://dev.twitter.com/oauth/overview/application-owner-access-tokens)

Once the values are assigned to environment variables, run this script as follows to set the values to the environment variables. 	
```
source 1.setVariable.sh
```
		
[2.deployEmailSvc-PythonMySQL.sh](2.deployEmailSvc-PythonMySQL.sh)
This script deploys email service written in python that uses MySQL database to store the emails. The gmail credentials required by this service are added as a configmap and assigned to the environment variables used by the python code. Run this code as follows

```
source 2.deployEmailSvc-PythonMySQL.sh
```

[3.deployTwitter-Tomcat.sh](3.deployTwitter-Tomcat.sh)
This script deploys the Twitter service written in Java. This service requires connection to Twitter. Twitter credentials are added as a configmap and are configured as environment variables that get the values from configmap. Run the script as follows

```
source 3.deployTwitter-Tomcat.sh
```


[4.deployUserRegBackend-NodejsMongo.sh](4.deployUserRegBackend-NodejsMongo.sh)
This script deploys the UserRegistration backed that is written in NodeJS. The data is saved to a MongoDB.

```
source 4.deployUserRegBackend-NodejsMongo.sh
```

[5.deployFrontend-PHP.sh](5.deployFrontend-PHP.sh)
This script deploys front-end microservice written in PHP. The resultant application should make REST calls to UserRegistration backend, and Twitter services.

```
source 5.deployFrontend-PHP.sh
```




