var mongoose = require('mongoose');
var Schema = mongoose.Schema;

// set up a mongoose model
module.exports = mongoose.model('User', new Schema({ 
	username: String, 
	email: String,
	password: String, 
	cpassword: String,
	twitterId: String,
	admin: Boolean 
}));
