-- trabalhoa2.users definition

CREATE DATABASE trabalhoa2;

USE DATABASE trabalhoa2;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- trabalhoa2.lanches definition

CREATE TABLE `lanches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` int unsigned NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lanches_user_id_foreign` (`user_id`),
  CONSTRAINT `lanches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- trabalhoa2.vendas definition

CREATE TABLE `vendas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `lanche_id` bigint unsigned NOT NULL,
  `quantity` int unsigned NOT NULL,
  `total_price` double NOT NULL,
  `date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendas_user_id_foreign` (`user_id`),
  KEY `vendas_lanche_id_foreign` (`lanche_id`),
  CONSTRAINT `vendas_lanche_id_foreign` FOREIGN KEY (`lanche_id`) REFERENCES `lanches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vendas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# DADOS PARA TESTE:

# Dados para Login:
# email do usuario: rafael@gmail.com
# senha do usuario: 00000000

INSERT INTO users
    (name, email, email_verified_at, password, remember_token, created_at, updated_at)
    VALUES('Rafael', 'rafael@gmail.com', NULL, '$2y$12$deuOb74cGc5DI3RxIL.ZNOGQDdldveCcZfe7G41TgVXP5XwTX0fOq', 'n5KxR3zCfm6zvgyDCOoNKaBESCJ9IptAtsVWHtXjIUAE6BVSUyhToHMnPcle', '2024-06-04 22:03:18', '2024-06-04 22:03:18');


INSERT INTO lanches
    (user_id, name, description, price, quantity, image_url, created_at, updated_at)
    VALUES(1, 'Hambúrguer de Picanha', 'Hambúrguer especial com picanha, alface, tomate, cebola roxa, queijo e molho especial.', 29.99, 189, 'users/1/images/$2y$12$5.NWlrkOylqoetefL0jeseLwFzxOJNO32X0CPQmKcIwiBRElgaK.png', '2024-06-04 22:09:25', '2024-06-04 22:20:06');
INSERT INTO lanches
    (user_id, name, description, price, quantity, image_url, created_at, updated_at)
    VALUES(1, 'Hambúrguer da Casa', 'Hambúrguer feito sob medida, incluindo tudo que há de melhor.', 22.99, 280, 'users/1/images/$2y$12$yBP856H03DkW9ks3ADmgAuKJ.K79s9mA4YDLwQ6h7C8FGdW7ZyDse.png', '2024-06-04 22:10:37', '2024-06-04 22:20:40');
INSERT INTO lanches
    (user_id, name, description, price, quantity, image_url, created_at, updated_at)
    VALUES(1, 'Hambúrguer de Bacon', 'Hambúrguer com bacon, carne, alface, tomate, queijo.', 26.99, 283, 'users/1/images/$2y$12$CiwNQmCyl4743K7NoUhTCOo6DQleIV.Uyjjhl3ybTPmicj4Dkpcra.png', '2024-06-04 22:12:44', '2024-06-04 22:20:23');
INSERT INTO lanches
    (user_id, name, description, price, quantity, image_url, created_at, updated_at)
    VALUES(1, 'Hambúrguer de Cachorro Quente', 'Hambúrguer com salsicha, batata palha, cheddar, queijo prata, alface, tomate e molho', 31.99, 124, 'users/1/images/$2y$12$qobqT5RvrFYyTiB6cxHHtevgOiBkICcNAteGegn35ZjjjyI7fR4TC.png', '2024-06-04 22:15:24', '2024-06-04 22:20:51');


INSERT INTO vendas
    (user_id, lanche_id, quantity, total_price, `date`, created_at, updated_at)
    VALUES(1, 1, 11, 329.89, '2024-06-01 00:00:00', '2024-06-04 22:20:06', '2024-06-04 22:20:06');
INSERT INTO vendas
    (user_id, lanche_id, quantity, total_price, `date`, created_at, updated_at)
    VALUES(1, 3, 17, 458.83, '2024-06-01 00:00:00', '2024-06-04 22:20:23', '2024-06-04 22:20:23');
INSERT INTO vendas
    (user_id, lanche_id, quantity, total_price, `date`, created_at, updated_at)
    VALUES(1, 2, 20, 459.8, '2024-06-01 00:00:00', '2024-06-04 22:20:40', '2024-06-04 22:20:40');
INSERT INTO vendas
    (user_id, lanche_id, quantity, total_price, `date`, created_at, updated_at)
    VALUES(1, 4, 26, 831.74, '2024-06-01 00:00:00', '2024-06-04 22:20:51', '2024-06-04 22:20:51');