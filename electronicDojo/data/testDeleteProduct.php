INSERT INTO `products` (`product_ID`, `product_name`, `bio`, `price`, `loyalty_points`, `brand`, `category`)
VALUES ('10', 'test', 'test', '1200.01', '50', 'test', 'Laptop');

INSERT INTO `laptop` (`laptop_ID`, `manufacturer`, `image`, `product_ID_laptop`) VALUES (NULL, 'test', 'null', '10');