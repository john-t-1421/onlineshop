SET FOREIGN_KEY_CHECKS = 0;

drop table if exists shop.users;
CREATE TABLE shop.users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_type INT NOT NULL DEFAULT 1 ,
    CHECK (user_type = 0 || user_type = 1)
);
drop table if exists shop.products;
CREATE TABLE shop.products (
	id int(11) NOT NULL AUTO_INCREMENT,
	name varchar(200) NOT NULL,
	desc_ text NOT NULL,
	price decimal(7,2) NOT NULL,
	quantity int(11) NOT NULL,
	img text NOT NULL,
	date_added datetime  DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);
drop table if exists shop.carts;
CREATE TABLE shop.carts (
    user_id INT NOT NULL,
    product_id INT NOT NULL ,
    qty INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES shop.users(id),
    FOREIGN KEY (product_id) REFERENCES shop.products(id),
    PRIMARY KEY(user_id, product_id)
    
);


INSERT INTO shop.products (id, name, desc_, price, quantity, img, date_added) VALUES
(1, 'Smart Watch', '<p>Coole Uhr aus Stahl für coole Leute.</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Reicht für die Uhrzeit</li>\r\n<li>Passt jedem sehr gut</li>\r\n<li>lange Batterielebenszeit</li>\r\n<li>Leicht und schick</li>\r\n</ul>', '29.99', 10, 'watch.jpg', CURRENT_TIMESTAMP ),
(2 ,'Brieftasche', '<p>Sehr schicke Brieftasche</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Mit Geldklammer</li>\r\n<li>Ein Muss für jeden Ehrenmann</li>\r\n<li>2 Jahre Garantie</li>\r\n<li>LLeicht und handy</li>\r\n</ul>', '10.99', 10, 'wallet.jpg' , CURRENT_TIMESTAMP),
(3, 'Kamera', '<p>Beste Kamera derzeit</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Mehr Megapixel gehen nicht</li>\r\n<li>Passt in jede Tasche</li>\r\n<li>bester USB-Anschluss der Welt</li>\r\n<li>Leicht und praktisch</li>\r\n</ul>', '352.99', 10, 'camera.jpg', CURRENT_TIMESTAMP ),
(4, 'Kopfhörer', '<p>Kopfhörer von Dr. Beats</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Empfängt auch Radio</li>\r\n<li>Und Spotify</li>\r\n<li>Läuft auf Akku.</li>\r\n<li>Leicht und schick</li>\r\n</ul>', '54.99', 10, 'headphones.jpg', CURRENT_TIMESTAMP ),
(5, 'Iphone12 mini', '<p>Bestes Handy derzeit</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>geht jetzt auch mit Android</li>\r\n<li>Kluge Leute haben Iphones</li>\r\n<li>Langes batterieleben</li>\r\n<li>Passt in jede Tasche</li>\r\n</ul>', '799.99', 10, 'iphone.jpg' , CURRENT_TIMESTAMP);


INSERT INTO shop.users(id, username, password, created_at, user_type) VALUES (0, 'admin', '$2y$12$bfKGlwUqfXcf8l29Vw.yduzmENwuWW4KoetZS1zXiKdMvdcDPT0ZS', current_timestamp, 0);

SET FOREIGN_KEY_CHECKS = 1;

