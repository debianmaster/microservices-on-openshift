



var express 	= require('express');
var app         = express();
var bodyParser  = require('body-parser');
var morgan      = require('morgan');
var mongoose    = require('mongoose');

var jwt    = require('jsonwebtoken'); 
var config = require('./config'); 
var User   = require('./app/models/user'); 
var cors = require('cors');

request = require('request-json');

var client = request.createClient(process.env.EMAIL_APPLICATION_DOMAIN);

var port = process.env.PORT || 8080; 
mongoose.connect(config.database); 
app.set('superSecret', config.secret); 
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());


app.use(morgan('dev'));

app.use(cors());



app.get('/setup', function(req, res) {

	
	var nick = new User({ 
		username: 'demo', 
		password: 'demo',
		admin: true 
	});
	nick.save(function(err) {
		if (err) throw err;
		console.log('User saved successfully');
		res.json({ success: true });
	});
});


app.get('/', function(req, res) {
	res.send('API Works!');
});

var apiRoutes = express.Router(); 


apiRoutes.post('/authenticate', function(req, res) {

	// find the user
	User.findOne({
		username: req.body.username,
		password: req.body.password
	}, function(err, user) {

		if (err) throw err;

		if (!user) {
			res.json({ success: false, message: 'Authentication failed. User not found.' });
		} else if (user) {

			// check if password matches
			if (user.password != req.body.password) {
				res.json({ success: false, message: 'Authentication failed. Wrong password.' });
			} else {

				// if user is found and password is right
				// create a token
				var token = jwt.sign(user, app.get('superSecret'), {
					expiresIn: 86400 // expires in 24 hours
				});

				res.json({
					success: true,
					message: 'Enjoy your token!',
					token: token
				});
			}		

		}

	});
});


apiRoutes.use(function(req, res, next) {

	
	var token = req.body.token || req.param('token') || req.headers['x-access-token'];

	
	if (token) {

		
		jwt.verify(token, app.get('superSecret'), function(err, decoded) {			
			if (err) {
				return res.json({ success: false, message: 'Failed to authenticate token.' });		
			} else {
				
				req.decoded = decoded;	
				next();
			}
		});

	} else {

		
		return res.status(403).send({ 
			success: false, 
			message: 'No token provided.'
		});
		
	}
	
});

apiRoutes.get('/', function(req, res) {
	res.json({ message: 'All Good!' });
});

app.post('/users', function(req, res) {
	var u = req.body;
	console.log('userobj',u,'email=',process.env.EMAIL_APPLICATION_DOMAIN);
	u.admin=false;
	var usr = new User(u);
	console.log(usr);
	usr.save(function(err,data) {
		if (err) throw err;
		data = {
			msg: "Signup complete!",
			subject: "Registration",
			to: req.body.email
		}
		console.log('data',data);
		client.post('/email/', data, function(err, response, body) {
  			console.log('email sent!');	
		});
	});
	res.json({ success: true });
});

apiRoutes.get('/users', function(req, res) {
	User.find({},{username:1,email:1,twitterId:1}, function(err, users) {
		res.json(users);
	});
});

apiRoutes.get('/check', function(req, res) {
	res.json(req.decoded);
});

app.use('/api', apiRoutes);


app.listen(port);
console.log('Magic happens at http://localhost:' + port);
console.log(process.ENV);
