oc project $OSE_SERVICES_PROJECT
oc import-image --from=registry.access.redhat.com/jboss-webserver-3/webserver30-tomcat8-openshift tomcat8 --confirm

oc new-app \
https://github.com/veermuchandi/microservices-on-openshift.git \
--context-dir='java-twitter-feed-api' \
--image-stream='tomcat8'  \
--name='twitter-api' -l microservice=twittersvc

oc create configmap twitter-props \
 --from-literal=TWITTER_CONSUMER_KEY=$TWITTER_CONSUMER_KEY \
 --from-literal=TWITTER_CONSUMER_SERVICE=$TWITTER_CONSUMER_SECRET \
 --from-literal=TWITTER_OAUTH_ACCESS_TOKEN=$TWITTER_OAUTH_ACCESS_TOKEN \
 --from-literal=TWITTER_OAUTH_ACCESS_TOKEN_SECRET=$TWITTER_OAUTH_ACCESS_TOKEN_SECRET

oc env dc/twitter-api --from=configmap/twitter-props

oc expose svc/twitter-api
