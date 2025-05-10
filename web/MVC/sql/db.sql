DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    role VARCHAR(25) NOT NULL DEFAULT 'user',
    pwd VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO users (uuid, username, email, role, pwd)
VALUES 
(UUID(), 'root', 'super.admin@hotpot.com', 'super', 'aaAA11'),
(UUID(), 'user2', 'user2@example.com', 'user', 'password456'),
(UUID(), 'user3', 'user3@example.com', 'admin', 'password789'),
(UUID(), 'user4', 'user4@example.com', 'user', 'password101'),
(UUID(), 'user5', 'user5@example.com', 'admin', 'password202');


CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255) -- path or filename of the image
);


INSERT INTO products (product_name, price, description, image) VALUES
('Margherita Pizza', 8.99, 'Classic pizza with tomato sauce, mozzarella, and fresh basil.', 'images/margherita_pizza.jpg'),
('Cheeseburger', 6.49, 'Grilled beef patty with cheddar cheese, lettuce, and tomato.', 'images/cheeseburger.jpg'),
('Caesar Salad', 5.99, 'Romaine lettuce with Caesar dressing, croutons, and parmesan.', 'images/caesar_salad.jpg'),
('Spaghetti Bolognese', 9.50, 'Pasta with rich tomato and beef sauce, topped with parmesan.', 'images/spaghetti_bolognese.jpg'),
('Chicken Shawarma Wrap', 7.25, 'Grilled spiced chicken in flatbread with garlic sauce.', 'images/shawarma_wrap.jpg'),
('Sushi Combo', 12.99, 'Assorted sushi rolls with soy sauce and wasabi.', 'images/sushi_combo.jpg'),
('Chocolate Cake', 4.75, 'Moist chocolate cake with layers of chocolate frosting.', 'images/chocolate_cake.jpg'),
('Grilled Salmon', 13.99, 'Salmon fillet served with steamed vegetables and lemon.', 'images/grilled_salmon.jpg'),
('Avocado Toast', 4.50, 'Toasted bread topped with mashed avocado and poached egg.', 'images/avocado_toast.jpg'),
('French Fries', 2.99, 'Crispy golden potato fries with a side of ketchup.', 'images/french_fries.jpg');
