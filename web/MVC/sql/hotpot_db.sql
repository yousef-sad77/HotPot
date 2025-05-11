-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 11:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotpot_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `description`, `long_description`, `image`, `uuid`, `amount`) VALUES
(97, 'Margherita Pizza', 8.99, 'Classic pizza with tomato sauce, mozzarella, and fresh basil.', 'Our Margherita Pizza is a traditional Italian favorite featuring a thin, crispy crust topped with rich tomato sauce, creamy mozzarella cheese, and fragrant fresh basil. Baked to perfection, it’s a simple yet satisfying meal that celebrates high-quality ingredients and classic flavors.', '/assets/images/margherita_pizza.jpg', '7ec83a2d-2dbe-11f0-9cef-7c10c9913e1d', 25),
(98, 'Cheeseburger', 6.49, 'Grilled beef patty with cheddar cheese, lettuce, and tomato.', 'This hearty cheeseburger features a juicy grilled beef patty layered with melted cheddar cheese, fresh lettuce, ripe tomato slices, and tangy pickles on a toasted bun. Served with your choice of condiments, it’s a timeless classic that delivers bold flavors in every bite.', '/assets/images/chees_burger.jpg', '7ec8428d-2dbe-11f0-9cef-7c10c9913e1d', 30),
(99, 'Caesar Salad', 5.99, 'Romaine lettuce with Caesar dressing, croutons, and parmesan.', 'Our Caesar Salad is a crisp and refreshing blend of romaine lettuce tossed in creamy Caesar dressing, garnished with crunchy garlic croutons and freshly grated parmesan cheese. A perfect balance of savory and fresh, ideal as a light meal or side dish.', '/assets/images/caesar_salad.jpg', '7ec84311-2dbe-11f0-9cef-7c10c9913e1d', 15),
(100, 'Spaghetti Bolognese', 9.50, 'Pasta with rich tomato and beef sauce, topped with parmesan.', 'Enjoy the comforting flavors of our Spaghetti Bolognese, made with al dente pasta smothered in a hearty tomato-based meat sauce. Simmered with herbs and topped with shaved parmesan, this dish brings authentic Italian home-style cooking to your table.', '/assets/images/spaghetti_bolognese.jpg', '7ec8433c-2dbe-11f0-9cef-7c10c9913e1d', 20),
(101, 'Chicken Shawarma Wrap', 7.25, 'Grilled spiced chicken in flatbread with garlic sauce.', 'The Chicken Shawarma Wrap combines marinated grilled chicken with crisp vegetables, creamy garlic sauce, and tangy pickles, all wrapped in warm flatbread. Bursting with Middle Eastern spices, it’s a flavorful and satisfying handheld meal.', '/assets/images/chorizo-mozarella-gnocchi-bake-cropped.jpg', '7ec84362-2dbe-11f0-9cef-7c10c9913e1d', 18),
(102, 'Sushi Combo', 12.99, 'Assorted sushi rolls with soy sauce and wasabi.', 'This Sushi Combo features a selection of hand-rolled sushi made with the freshest ingredients including tuna, salmon, cucumber, and avocado. Served with soy sauce, pickled ginger, and wasabi, it’s a well-rounded meal for sushi lovers.', '/assets/images/french_fries.jpg', '7ec84384-2dbe-11f0-9cef-7c10c9913e1d', 22),
(104, 'Grilled Salmon', 13.99, 'Salmon fillet served with steamed vegetables and lemon.', 'Treat yourself to our Grilled Salmon, a perfectly cooked fillet seasoned with herbs and grilled to a delicate flake. Paired with steamed seasonal vegetables and a wedge of lemon, it’s a healthy and delicious option packed with flavor.', '/assets/images/grilled_salmon.jpg', '7ec843ca-2dbe-11f0-9cef-7c10c9913e1d', 10),
(105, 'Avocado Toast', 4.50, 'Toasted bread topped with mashed avocado and poached egg.', 'Our Avocado Toast is made with artisan bread, lightly toasted and topped with creamy mashed avocado, a perfectly poached egg, and a sprinkle of seasoning. A nutritious, trendy dish that’s great for breakfast or a light lunch.', '/assets/images/avocado_toast.jpg', '7ec843ed-2dbe-11f0-9cef-7c10c9913e1d', 35);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(25) NOT NULL DEFAULT 'user',
  `pwd` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `username`, `email`, `role`, `pwd`, `created_at`) VALUES
(33, '25f217ec-2da2-11f0-9cef-7c10c9913e1d', 'root', 'super.admin@hotpot.com', 'super', '$2y$12$GZFYpDbDc8DrPzm0Hfd8J.glboK/IO8kLybSV369uWlTOuCO6fD2C', '2025-05-10 13:24:49'),
(35, '25f230e4-2da2-11f0-9cef-7c10c9913e1d', 'user2', 'user3@admin.example.com', 'admin', '$2y$12$1AMob8tA0wmbkcjfLBilEOcVeD/.k5e8mNOUg2EzoZa2JAclwY2Z2', '2025-05-10 13:24:49'),
(37, '25f23179-2da2-11f0-9cef-7c10c9913e1d', 'user4', 'user5@admin.example.com', 'admin', '$2y$12$K/dRvi1arhok9gkmzkO7KOKI7lXJRJPmPopnGwazozFixo2Z1AZMa', '2025-05-10 13:24:49'),
(39, '3d9abe38-2dae-11f0-9cef-7c10c9913e1d', 'yousef', 'youseven77.sad@gmail.com', 'user', '$2y$12$yuvb6pvA0qXx67hs.JElwuo7YI7ZsbHOM6iH7fPpZglxWSLET2q7q', '2025-05-10 14:51:22'),
(40, 'e9c97611-2dae-11f0-9cef-7c10c9913e1d', 'yousefAdmin', 'yousef@admin.hotpot.com', 'admin', '$2y$12$CBXVeGZ47PoURUqCtcYvqevfxtwU6HcMuLcg1sjdL8AzHRzjVmVES', '2025-05-10 14:56:11'),
(43, 'e5f4ca02-2dca-11f0-9cef-7c10c9913e1d', 'user5', 'user5@gmail.com', 'user', '$2y$10$u.3WoButqV95hdxXnU34PuB53tSZNnjXFZwU1T7WV5S63.Ji7aA2u', '2025-05-10 18:16:31'),
(44, 'fd5975e2-2ddf-11f0-830e-7c10c9913e1d', 'ahamd', 'ahamd@gmail.com', 'user', '$2y$12$irx5Q5s5ieRM3eKtlQmo8.cPOrnu2hOfocWyvWQ5nCrR3vKgOgwUS', '2025-05-10 20:47:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
