oc project $OSE_SERVICES_PROJECT

export EMAIL_SERVICE_URL="http://emailsvc."$OSE_INFRA_PROJECT":8080"
export USER_SERVICE_URL="http://userregsvc."$OSE_SERVICES_PROJECT":8080"

oc new-app -e EMAIL_SERVICE_URL=$EMAIL_SERVICE_URL \
USER_SERVICE_URL=$USER_SERVICE_URL \
--context-dir='golang-products-api' \
https://github.com/debianmaster/microservices-on-openshift.git \
--name='products-api' -l microservice=productssvc

oc expose svc/products-api

