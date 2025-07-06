# Use Node.js 14 base image
FROM node:14-alpine

# Set working directory
WORKDIR /app

# Copy package.json first for better Docker layer caching
COPY package.json ./

# Install dependencies
RUN npm install

# Copy source code
COPY server.js ./
COPY config.js ./
COPY test.js ./
COPY app/ ./app/

# Expose port 8080
EXPOSE 8080

# Set environment variables for MongoDB connection
ENV MONGODB_USER=""
ENV MONGODB_PASSWORD=""
ENV MONGODB_DATABASE=""
ENV DATABASE_SERVICE_NAME=""

# Set environment variable for email service connection
ENV EMAIL_APPLICATION_DOMAIN=""

# Start application with node server.js
CMD ["node", "server.js"]

