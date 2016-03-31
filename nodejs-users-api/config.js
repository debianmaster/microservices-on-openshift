var mongoServiceName = process.env.DATABASE_SERVICE_NAME.toUpperCase();
var mongoHost = process.env[mongoServiceName + "_SERVICE_HOST"];
var mongoPort = process.env[mongoServiceName + "_SERVICE_PORT"];
console.log("mongohost:port ="+mongoHost+":"+mongoPort);
module.exports = {
	'secret': 'saregama',
	//'database':'mongodb://localhost/demo'
	//'database': 'mongodb://'+process.env.MONGODB_USER+':'+process.env.MONGODB_PASSWORD+'@'+process.env.MONGODB_SERVICE_HOST+':27017/'+process.env.MONGODB_DATABASE
	'database': 'mongodb://'+process.env.MONGODB_USER+':'+process.env.MONGODB_PASSWORD+'@'+mongoHost+':'+mongoPort+'/'+process.env.MONGODB_DATABASE
};
