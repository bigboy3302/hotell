
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` BOOLEAN NOT NULL DEFAULT false,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE apartments (
    `apartment_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `amount` INT NOT NULL DEFAULT 0,
    `stars` BOOLEAN NOT NULL DEFAULT false,
    `image_url` VARCHAR(255),
    `description` TEXT,
    `date` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE reservations (
    `reserve_id` INT AUTO_INCREMENT PRIMARY KEY,
    `apartment_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `amount` INT NOT NULL,
    `stars` INT NOT NULL,
    `date` DATE NOT NULL,
    FOREIGN KEY (`apartment_id`) REFERENCES apartments(`apartment_id`),
    FOREIGN KEY (`user_id`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Inserting into the apartments table with different values
INSERT INTO apartments (name, price, amount, stars, image_url, description, date)
VALUES 
('Urban Oasis', 220.00, 8, 5, '', 'An urban oasis with a rooftop garden and city skyline views.', '2024-06-10'),
('Mountain Retreat', 180.00, 6, 4, '', 'A peaceful retreat in the mountains, perfect for nature lovers.', '2024-06-11'),
('Seaside Escape', 300.00, 5, 5, '', 'A luxurious escape by the sea with private beach access.', '2024-06-12'),
('Historic Haven', 160.00, 7, 3, '', 'A charming apartment in a historic building.', '2024-06-13'),
('Countryside Villa', 275.00, 4, 4, '', 'A spacious villa in the countryside with modern amenities.', '2024-06-14');

-- Creating the reviews table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    apartment VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    experience TEXT NOT NULL,
    stars INT NOT NULL
);

-- Inserting into the reviews table with different values
INSERT INTO reviews (apartment, name, experience, stars) VALUES 
('Urban Oasis', 'Eve Adams', 'Fantastic location and beautiful views!', 5),
('Mountain Retreat', 'Tom Black', 'Perfect getaway, very relaxing.', 4),
('Seaside Escape', 'Sara White', 'Absolutely loved it, will visit again.', 5),
('Historic Haven', 'Mike Green', 'Interesting place but a bit noisy.', 3),
('Countryside Villa', 'Lucy Blue', 'Wonderful stay, highly recommend!', 5);
