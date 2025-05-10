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

INSERT INTO users (uuid, username, email, role, pwd) VALUES
    (UUID(), 'root', 'super.admin@hotpot.com', 'super', '$2y$12$GZFYpDbDc8DrPzm0Hfd8J.glboK/IO8kLybSV369uWlTOuCO6fD2C'),
    (UUID(), 'user1', 'user2@gmail.com', 'user', '$2y$12$jj3Ag0.BzddY6O1AGx075Oz76eXbJcjPPwBle.KzGCFNV/8LZ71WK'),
    (UUID(), 'admin1', 'user3@admin.hotpot.com', 'admin', '$2y$12$1AMob8tA0wmbkcjfLBilEOcVeD/.k5e8mNOUg2EzoZa2JAclwY2Z2'),
    (UUID(), 'user3', 'user4@gmail.com', 'user', '$2y$12$/CrlEclJwRiCTkVzFVRrr.rJT10bJU9ffPT5leZ8vibD1pJAdfzhW'),
    (UUID(), 'admin2', 'user5@admin.hotpot.com', 'admin', '$2y$12$K/dRvi1arhok9gkmzkO7KOKI7lXJRJPmPopnGwazozFixo2Z1AZMa');

-- yousefAdmin: password is "bbbbBBBB2222"
INSERT INTO users (id, uuid, username, email, role, pwd, created_at) VALUES
(NULL, 'e9c97611-2dae-11f0-9cef-7c10c9913e1d', 'yousefAdmin', 'yousef@admin.hotpot.com', 'admin', '$2y$12$CBXVeGZ47PoURUqCtcYvqevfxtwU6HcMuLcg1sjdL8AzHRzjVmVES', '2025-05-10 17:56:11');

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    long_description TEXT,
    image VARCHAR(255),
    amount INT NOT NULL DEFAULT 0
);

INSERT INTO products (uuid, product_name, price, description, long_description, image, amount) VALUES
    (UUID(), 'Margherita Pizza', 8.99, 'Classic pizza with tomato sauce, mozzarella, and fresh basil.',
        'Our Margherita Pizza is a traditional Italian favorite featuring a thin, crispy crust topped with rich tomato sauce, creamy mozzarella cheese, and fragrant fresh basil. Baked to perfection, it’s a simple yet satisfying meal that celebrates high-quality ingredients and classic flavors.',
        '/assets/images/margherita_pizza.jpg', 25),

    (UUID(), 'Cheeseburger', 6.49, 'Grilled beef patty with cheddar cheese, lettuce, and tomato.',
        'This hearty cheeseburger features a juicy grilled beef patty layered with melted cheddar cheese, fresh lettuce, ripe tomato slices, and tangy pickles on a toasted bun. Served with your choice of condiments, it’s a timeless classic that delivers bold flavors in every bite.',
        '/assets/images/chees_burger.jpg', 30),

    (UUID(), 'Caesar Salad', 5.99, 'Romaine lettuce with Caesar dressing, croutons, and parmesan.',
        'Our Caesar Salad is a crisp and refreshing blend of romaine lettuce tossed in creamy Caesar dressing, garnished with crunchy garlic croutons and freshly grated parmesan cheese. A perfect balance of savory and fresh, ideal as a light meal or side dish.',
        '/assets/images/caesar_salad.jpg', 15),

    (UUID(), 'Spaghetti Bolognese', 9.50, 'Pasta with rich tomato and beef sauce, topped with parmesan.',
        'Enjoy the comforting flavors of our Spaghetti Bolognese, made with al dente pasta smothered in a hearty tomato-based meat sauce. Simmered with herbs and topped with shaved parmesan, this dish brings authentic Italian home-style cooking to your table.',
        '/assets/images/spaghetti_bolognese.jpg', 20),

    (UUID(), 'Chicken Shawarma Wrap', 7.25, 'Grilled spiced chicken in flatbread with garlic sauce.',
        'The Chicken Shawarma Wrap combines marinated grilled chicken with crisp vegetables, creamy garlic sauce, and tangy pickles, all wrapped in warm flatbread. Bursting with Middle Eastern spices, it’s a flavorful and satisfying handheld meal.',
        '/assets/images/chorizo-mozarella-gnocchi-bake-cropped.jpg', 18),

    (UUID(), 'Sushi Combo', 12.99, 'Assorted sushi rolls with soy sauce and wasabi.',
        'This Sushi Combo features a selection of hand-rolled sushi made with the freshest ingredients including tuna, salmon, cucumber, and avocado. Served with soy sauce, pickled ginger, and wasabi, it’s a well-rounded meal for sushi lovers.',
        '/assets/images/french_fries.jpg', 22),

    (UUID(), 'Chocolate Cake', 4.75, 'Moist chocolate cake with layers of chocolate frosting.',
        'Our Chocolate Cake is rich, moist, and decadently layered with creamy chocolate frosting. Made with premium cocoa and finished with a glossy ganache, it’s the perfect dessert for chocolate enthusiasts seeking indulgence.',
        '/assets/images/chocolate_cake.jpg', 40),

    (UUID(), 'Grilled Salmon', 13.99, 'Salmon fillet served with steamed vegetables and lemon.',
        'Treat yourself to our Grilled Salmon, a perfectly cooked fillet seasoned with herbs and grilled to a delicate flake. Paired with steamed seasonal vegetables and a wedge of lemon, it’s a healthy and delicious option packed with flavor.',
        '/assets/images/grilled_salmon.jpg', 10),

    (UUID(), 'Avocado Toast', 4.50, 'Toasted bread topped with mashed avocado and poached egg.',
        'Our Avocado Toast is made with artisan bread, lightly toasted and topped with creamy mashed avocado, a perfectly poached egg, and a sprinkle of seasoning. A nutritious, trendy dish that’s great for breakfast or a light lunch.',
        '/assets/images/avocado_toast.jpg', 35),

    (UUID(), 'French Fries', 2.99, 'Crispy golden potato fries with a side of ketchup.',
        'Enjoy our golden French Fries—crispy on the outside, fluffy on the inside. Served hot with a side of ketchup or your choice of dipping sauce, they’re the ideal side or snack to satisfy your craving for something salty and crunchy.',
        '/assets/images/shawarma_wrap.jpg', 50);
