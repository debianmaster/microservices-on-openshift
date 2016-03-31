
package com.example;
 

import java.util.ArrayList;
import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import twitter4j.Query;
import twitter4j.QueryResult;
import twitter4j.Twitter;
import twitter4j.TwitterException;
import twitter4j.TwitterFactory;
import twitter4j.conf.ConfigurationBuilder;

/**
 * Root resource (exposed at "myresource" path)
 */
@Path("tweets")
public class MyResource {
    

    @GET
    @Produces(MediaType.APPLICATION_JSON)
    public Response getIt(@QueryParam("name") String name) {

        User u = new User();
        List<String> tweetsFromUser = new ArrayList<String>();

        try {

            ConfigurationBuilder cb = new ConfigurationBuilder();
            cb.setDebugEnabled(true)
                    .setOAuthConsumerKey("DPvTS3jiK9FA5A51FwkIFO3l7")
                    .setOAuthConsumerSecret(
                            "ss44Xy3S9lmwAQSe3kbseVmyZmpjeopIXtH7fUTqtZqDW5FICs")
                    .setOAuthAccessToken(
                            "281649701-ZjJVyFrgeG1OtEOGuzmcwGCj7WzxZvlsRJVM70CV")
                    .setOAuthAccessTokenSecret(
                            "XyKNiKsABTc9bMvxmIrJ0w2hsR6k3Fdu1gHdF54W2CVYu");
            TwitterFactory tf = new TwitterFactory(cb.build());
            Twitter twitter = tf.getInstance();

            Query query = new Query(name);
            QueryResult result;
            do {
                result = twitter.search(query);
                List<twitter4j.Status> tweets = result.getTweets();
                for (twitter4j.Status tweet : tweets) {
                    System.out.println("@" + tweet.getUser().getScreenName() + " - " + tweet.getText());
                    tweetsFromUser.add(tweet.getText());
                }
            } while ((query = result.nextQuery()) != null);
            
        } catch (TwitterException te) {
            te.printStackTrace();
            tweetsFromUser.add("Exception occurred..!!!");
        }

        u.setTweets(tweetsFromUser);

        return Response.status(200).entity(u).build();
    }

}