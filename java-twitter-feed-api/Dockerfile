# Multi-stage build for Java Twitter Feed API
# Stage 1: Build the application
FROM openjdk:8-jdk-alpine AS builder

# Install Maven
RUN apk add --no-cache maven

# Set working directory
WORKDIR /app

# Copy pom.xml first for better Docker layer caching
COPY pom.xml .

# Download dependencies
RUN mvn dependency:go-offline -B

# Copy source code
COPY src ./src

# Build the WAR file
RUN mvn clean package -DskipTests

# Stage 2: Runtime with Tomcat 8
FROM tomcat:8-jre8-alpine

# Remove default webapps
RUN rm -rf /usr/local/tomcat/webapps/*

# Copy the WAR file from builder stage
COPY --from=builder /app/target/simple-service-webapp.war /usr/local/tomcat/webapps/ROOT.war

# Set environment variables for Twitter OAuth credentials
ENV TWITTER_CONSUMER_KEY=""
ENV TWITTER_CONSUMER_SERVICE=""
ENV TWITTER_OAUTH_ACCESS_TOKEN=""
ENV TWITTER_OAUTH_ACCESS_TOKEN_SECRET=""

# Expose port 8080
EXPOSE 8080

# Start Tomcat
CMD ["catalina.sh", "run"]

