package main

import (
	"net/http"
	"os"
	"strconv"
	"time"

	"github.com/gin-contrib/cors"
	"github.com/gin-gonic/gin"
)

// Product represents a product in our system
type Product struct {
	ID          int       `json:"id"`
	Name        string    `json:"name"`
	Description string    `json:"description"`
	Price       float64   `json:"price"`
	Category    string    `json:"category"`
	InStock     bool      `json:"inStock"`
	CreatedAt   time.Time `json:"createdAt"`
}

// In-memory storage for products
var products []Product
var nextID int = 1

func main() {
	// Initialize some sample products
	initSampleProducts()

	// Create Gin router
	r := gin.Default()

	// Configure CORS
	config := cors.DefaultConfig()
	config.AllowAllOrigins = true
	config.AllowMethods = []string{"GET", "POST", "PUT", "DELETE", "OPTIONS"}
	config.AllowHeaders = []string{"Origin", "Content-Type", "Accept", "Authorization", "X-Requested-With"}
	r.Use(cors.New(config))

	// Health check endpoint
	r.GET("/", func(c *gin.Context) {
		c.JSON(http.StatusOK, gin.H{
			"message": "Products API Works!",
			"status":  "healthy",
		})
	})

	// API routes
	api := r.Group("/api")
	{
		// GET /api/products - List all products
		api.GET("/products", getProducts)
		
		// POST /api/products - Create a new product
		api.POST("/products", createProduct)
		
		// GET /api/products/:id - Get product by ID
		api.GET("/products/:id", getProductByID)
		
		// PUT /api/products/:id - Update product by ID
		api.PUT("/products/:id", updateProduct)
		
		// DELETE /api/products/:id - Delete product by ID
		api.DELETE("/products/:id", deleteProduct)
	}

	// Get port from environment or default to 8080
	port := os.Getenv("PORT")
	if port == "" {
		port = "8080"
	}

	// Start server
	r.Run(":" + port)
}

func initSampleProducts() {
	products = []Product{
		{ID: 1, Name: "Laptop", Description: "High-performance laptop", Price: 999.99, Category: "Electronics", InStock: true, CreatedAt: time.Now()},
		{ID: 2, Name: "Coffee Mug", Description: "Ceramic coffee mug", Price: 12.99, Category: "Kitchen", InStock: true, CreatedAt: time.Now()},
		{ID: 3, Name: "Book", Description: "Programming guide", Price: 29.99, Category: "Books", InStock: false, CreatedAt: time.Now()},
	}
	nextID = 4
}

func getProducts(c *gin.Context) {
	c.JSON(http.StatusOK, gin.H{
		"success": true,
		"data":    products,
		"count":   len(products),
	})
}

func createProduct(c *gin.Context) {
	var newProduct Product
	
	if err := c.ShouldBindJSON(&newProduct); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"success": false,
			"error":   "Invalid JSON data",
		})
		return
	}

	// Set ID and creation time
	newProduct.ID = nextID
	newProduct.CreatedAt = time.Now()
	nextID++

	// Add to products slice
	products = append(products, newProduct)

	c.JSON(http.StatusCreated, gin.H{
		"success": true,
		"data":    newProduct,
		"message": "Product created successfully",
	})
}

func getProductByID(c *gin.Context) {
	id, err := strconv.Atoi(c.Param("id"))
	if err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"success": false,
			"error":   "Invalid product ID",
		})
		return
	}

	for _, product := range products {
		if product.ID == id {
			c.JSON(http.StatusOK, gin.H{
				"success": true,
				"data":    product,
			})
			return
		}
	}

	c.JSON(http.StatusNotFound, gin.H{
		"success": false,
		"error":   "Product not found",
	})
}

func updateProduct(c *gin.Context) {
	id, err := strconv.Atoi(c.Param("id"))
	if err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"success": false,
			"error":   "Invalid product ID",
		})
		return
	}

	var updatedProduct Product
	if err := c.ShouldBindJSON(&updatedProduct); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"success": false,
			"error":   "Invalid JSON data",
		})
		return
	}

	for i, product := range products {
		if product.ID == id {
			// Preserve ID and creation time
			updatedProduct.ID = id
			updatedProduct.CreatedAt = product.CreatedAt
			products[i] = updatedProduct
			
			c.JSON(http.StatusOK, gin.H{
				"success": true,
				"data":    updatedProduct,
				"message": "Product updated successfully",
			})
			return
		}
	}

	c.JSON(http.StatusNotFound, gin.H{
		"success": false,
		"error":   "Product not found",
	})
}

func deleteProduct(c *gin.Context) {
	id, err := strconv.Atoi(c.Param("id"))
	if err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"success": false,
			"error":   "Invalid product ID",
		})
		return
	}

	for i, product := range products {
		if product.ID == id {
			// Remove product from slice
			products = append(products[:i], products[i+1:]...)
			
			c.JSON(http.StatusOK, gin.H{
				"success": true,
				"message": "Product deleted successfully",
			})
			return
		}
	}

	c.JSON(http.StatusNotFound, gin.H{
		"success": false,
		"error":   "Product not found",
	})
}

