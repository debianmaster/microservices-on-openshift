package com.example;

import java.util.List;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement
@XmlAccessorType(XmlAccessType.FIELD)
public class User {
 
    private List<String> tweets;
     
    public List<String> getTweets() {
		return tweets;
	}

	public void setTweets(List<String> tweets) {
		this.tweets = tweets;
	}

}