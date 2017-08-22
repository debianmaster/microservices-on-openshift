oc project $OSE_SERVICES_PROJECT

export EMAIL_SERVICE_URL="http://emailsvc."$OSE_INFRA_PROJECT":8080"

oc new-app -e MONGODB_USER=mongouser MONGODB_PASSWORD=password \
MONGODB_DATABASE=userdb MONGODB_ADMIN_PASSWORD=password \
  registry.access.redhat.com/rhscl/mongodb-26-rhel7 \
--name mongodb -l microservice=userregsvc

oc deploy mongodb --latest

oc new-app -e EMAIL_APPLICATION_DOMAIN=$EMAIL_SERVICE_URL \
MONGODB_DATABASE=userdb MONGODB_PASSWORD=password \
MONGODB_USER=mongouser DATABASE_SERVICE_NAME=mongodb \
--context-dir='nodejs-users-api' \
https://github.com/debianmaster/microservices-on-openshift.git \
--name='userregsvc' -l microservice=userregsvc

oc expose svc/userregsvc
