oc project $OSE_CLIENT_PROJECT
oc new-app -e USER_REG_SVC="http://userregsvc-$OSE_SERVICES_PROJECT.$OSE_DOMAIN" \
-e TWITTER_FEED_SVC="http://twitter-api-$OSE_SERVICES_PROJECT.$OSE_DOMAIN" \
--context-dir='php-ui' \
https://github.com/veermuchandi/microservices-on-openshift.git \
--name='userreg' \
-l microservice=userreg
oc expose svc/userreg
