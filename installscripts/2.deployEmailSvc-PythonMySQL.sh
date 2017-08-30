oc project $OSE_INFRA_PROJECT
oc new-app -e MYSQL_USER='app_user' \
MYSQL_PASSWORD='password' \
MYSQL_DATABASE=microservices \
 registry.access.redhat.com/rhscl/mysql-56-rhel7 --name='mysql' -l microservice=emailsvc

sleep 10

oc deploy mysql --cancel

oc patch dc/mysql --patch '{"spec":{"strategy":{"rollingParams":{"post":{"failurePolicy": "ignore","execNewPod":{"containerName":"mysql","command":["/bin/sh","-c","hostname&&sleep 10&&echo $QUERY | /opt/rh/rh-mysql56/root/usr/bin/mysql -h $MYSQL_SERVICE_HOST -u $MYSQL_USER -D $MYSQL_DATABASE -p$MYSQL_PASSWORD -P 3306"], "env": [{"name": "QUERY", "value":"CREATE TABLE IF NOT EXISTS emails \u0028from_add varchar\u002840\u0029,to_add varchar\u002840\u0029, subject varchar\u002840\u0029, body varchar\u0028200\u0029, created_at date\u0029;"}]}}}}}}'

oc rollout latest mysql

oc new-app --context-dir='python-email-api' \
  -e EMAIL_APPLICATION_DOMAIN=http://emailsvc:8080 \
MYSQL_USER='app_user' \
MYSQL_PASSWORD='password' \
MYSQL_DATABASE='microservices' \
MYSQL_SERVICE_HOST='MYSQL' \
  https://github.com/veermuchandi/microservices-on-openshift.git \
  --name=emailsvc --image-stream='python:2.7'  -l microservice=emailsvc

oc create configmap email-props --from-literal=GMAIL_USERNAME=$FROM_GMAIL --from-literal=GMAIL_PASSWORD=$FROM_GMAIL_PASSWORD
oc env dc/emailsvc --from=configmap/email-props 

