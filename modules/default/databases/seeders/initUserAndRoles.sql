INSERT INTO `roles` (`id`,`name`) VALUES (1, 'Super Admin');
INSERT INTO `users` (`id`,`name`, `username`, `password`) VALUES (1, 'Administrator','admin', md5('admin'));
INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES (1, 1);
INSERT INTO `role_routes` (`route_path`, `role_id`) VALUES ('*', 1);