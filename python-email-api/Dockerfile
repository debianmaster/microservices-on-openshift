# Use Python 3.8 base image
FROM python:3.8-alpine

# Set working directory
WORKDIR /app

# Copy requirements.txt first for better Docker layer caching
COPY requirements.txt .

# Install Python dependencies
RUN pip install --no-cache-dir -r requirements.txt

# Copy source code
COPY sample.py .
COPY setup.py .

# Set environment variables for Gmail SMTP
ENV GMAIL_USERNAME=""
ENV GMAIL_PASSWORD=""

# Set environment variables for MySQL connection
ENV MYSQL_USER=""
ENV MYSQL_PASSWORD=""
ENV MYSQL_SERVICE_HOST=""
ENV MYSQL_DATABASE=""

# Expose port 8080
EXPOSE 8080

# Start application with gunicorn WSGI server
# The WSGI application is defined as 'api' in sample.py
CMD ["gunicorn", "--bind", "0.0.0.0:8080", "sample:api"]

