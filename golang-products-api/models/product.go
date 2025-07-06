package models

import "time"

// Product represents a product in the system
type Product struct {
	ID          int       `json:"id"`
	Name        string    `json:"name"`
	Description string    `json:"description"`
	Price       float64   `json:"price"`
	Category    string    `json:"category"`
	InStock     bool      `json:"inStock"`
	CreatedAt   time.Time `json:"createdAt"`
}

