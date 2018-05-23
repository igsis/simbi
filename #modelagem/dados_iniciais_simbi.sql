-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.31-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando dados para a tabela simbi.distritos: ~0 rows (aproximadamente)
DELETE FROM `distritos`;
/*!40000 ALTER TABLE `distritos` DISABLE KEYS */;
/*!40000 ALTER TABLE `distritos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.enderecos: ~0 rows (aproximadamente)
DELETE FROM `enderecos`;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamentos: ~0 rows (aproximadamente)
DELETE FROM `equipamentos`;
/*!40000 ALTER TABLE `equipamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamentos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamentos_users: ~0 rows (aproximadamente)
DELETE FROM `equipamento_user`;
/*!40000 ALTER TABLE `equipamento_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamento_user` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamento_siglas: ~0 rows (aproximadamente)
DELETE FROM `equipamento_siglas`;
/*!40000 ALTER TABLE `equipamento_siglas` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamento_siglas` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.macrorregiao: ~0 rows (aproximadamente)
DELETE FROM `macrorregiao`;
/*!40000 ALTER TABLE `macrorregiao` DISABLE KEYS */;
INSERT INTO `macrorregiao` (`id`, `descricao`) VALUES
	(1, 'Centro'),
	(2, 'Noroeste'),
	(3, 'Norte'),
	(4, 'Leste 1'),
	(5, 'Leste 2'),
	(6, 'Leste 3'),
	(7, 'Leste 4'),
	(8, 'Sul 1'),
	(9, 'Sul 2'),
	(10, 'Sudoeste'),
	(11, 'Sudeste');
/*!40000 ALTER TABLE `macrorregiao` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.migrations: ~0 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.model_has_permissions: ~0 rows (aproximadamente)
DELETE FROM `model_has_permissions`;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.model_has_roles: ~6 rows (aproximadamente)
DELETE FROM `model_has_roles`;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
	(1, 1, 'Simbi\\Models\\User'),
	(2, 2, 'Simbi\\Models\\User'),
	(3, 3, 'Simbi\\Models\\User');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.password_resets: ~1 rows (aproximadamente)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('admin@teste.com', '$2y$10$GKOT81lQXh3QYLBDAZ2DfOsh1cJsYPqRJrmnHBWni/WvdA0JUVu2y', '2018-05-14 12:44:58');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.password_resets: ~4 rows (aproximadamente)
DELETE FROM `pergunta_segurancas`;
/*!40000 ALTER TABLE `pergunta_segurancas` DISABLE KEYS */;
INSERT INTO `pergunta_segurancas` (`id`, `pergunta_seguranca`) VALUES
	(1, 'Qual a sua cor favorita?'),
	(2, 'Qual o nome do seu primeiro animal?'),
	(3, 'Qual o nome do seu primeiro professor?'),
	(4, 'Qual o nome do seu melhor amigo de infância?');
/*!40000 ALTER TABLE `pergunta_segurancas` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.permissions: ~3 rows (aproximadamente)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'web', '2018-05-11 16:04:01', '2018-05-11 16:04:01'),
	(2, 'Coordenador', 'web', '2018-05-11 16:04:09', '2018-05-11 16:04:09'),
	(3, 'Funcionario', 'web', '2018-05-11 16:04:42', '2018-05-11 16:04:42');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.regiao: ~0 rows (aproximadamente)
DELETE FROM `regiao`;
/*!40000 ALTER TABLE `regiao` DISABLE KEYS */;
INSERT INTO `regiao` (`id`, `descricao`) VALUES
	(1, 'Norte'),
	(2, 'Sul'),
	(3, 'Leste'),
	(4, 'Oeste'),
	(5, 'Centro');
/*!40000 ALTER TABLE `regiao` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.regional: ~0 rows (aproximadamente)
DELETE FROM `regional`;
/*!40000 ALTER TABLE `regional` DISABLE KEYS */;
INSERT INTO `regional` (`id`, `descricao`) VALUES
	(1, 'Norte'),
	(2, 'Sul'),
	(3, 'Leste 1'),
	(4, 'Leste 2'),
	(5, 'Oeste'),
	(6, 'Centro');
/*!40000 ALTER TABLE `regional` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.roles: ~3 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'web', '2018-05-11 16:04:58', '2018-05-11 16:04:58'),
	(2, 'Coordenador', 'web', '2018-05-11 16:05:09', '2018-05-11 16:05:09'),
	(3, 'Funcionario', 'web', '2018-05-11 16:05:19', '2018-05-11 16:05:19');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.role_has_permissions: ~6 rows (aproximadamente)
DELETE FROM `role_has_permissions`;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(2, 2),
	(3, 1),
	(3, 2),
	(3, 3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.secretarias: ~0 rows (aproximadamente)
DELETE FROM `secretarias`;
/*!40000 ALTER TABLE `secretarias` DISABLE KEYS */;
/*!40000 ALTER TABLE `secretarias` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.status: ~0 rows (aproximadamente)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `descricao`) VALUES
	(1, 'Ativo'),
	(2, 'Inativo'),
	(3, 'Fechado');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.subordinacao_administrativas: ~0 rows (aproximadamente)
DELETE FROM `subordinacao_administrativas`;
/*!40000 ALTER TABLE `subordinacao_administrativas` DISABLE KEYS */;
/*!40000 ALTER TABLE `subordinacao_administrativas` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.subprefeituras: ~0 rows (aproximadamente)
DELETE FROM `subprefeituras`;
/*!40000 ALTER TABLE `subprefeituras` DISABLE KEYS */;
/*!40000 ALTER TABLE `subprefeituras` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.tipo_servicos: ~0 rows (aproximadamente)
DELETE FROM `tipo_servicos`;
/*!40000 ALTER TABLE `tipo_servicos` DISABLE KEYS */;
INSERT INTO `tipo_servicos` (`id`, `descricao`) VALUES
	(1, 'Bibliotecas CSMB'),
	(2, 'Bosque da Leitura'),
	(3, 'Ponto de Leitura'),
	(4, 'Ônibus Biblioteca'),
	(5, 'Caixa'),
	(6, 'Estante'),
	(7, 'Feira de Troca');
/*!40000 ALTER TABLE `tipo_servicos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.users: ~4 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `publicado`) VALUES
	(1, 'Admin', 'admin@teste.com', '$2y$10$QTa2XVi7nGlNvIyZiF7IGutDOPMQTwBm.3vpKB61Ly77oLnJ.rXyu', 'ftruU1O8HmmfGW11XhoQkAmZmPFPauSzOVlpGAvtkeDeN2F6A4b720xNZLb2', '2018-05-11 15:59:01', '2018-05-11 15:59:01', 1),
	(2, 'Coordenador', 'coordenador@teste.com.br', '$2y$10$7bQhXdsh5jdE6V6UuA9geOEg4vbMrRo/rFeEY.riwU5nDaws9tR9y', '0P9HnMF5YjfeoKLejOd6uDc4N4jTDfhiS0e9FFyIkJW1ukM35EPoQVWZnYTg', '2018-05-14 15:06:45', '2018-05-14 15:06:45', 1),
	(3, 'Funcionario', 'func@teste.com.br', '$2y$10$AW7Mggvjj/HArXAjpyhAN.Z3ehFnVOkBxVofknq1iuAHoR667.ElC', 'kIoobYgkEjLcxSJVqzYvdadvgkfoLum7gOpMpr0eedJjZx3m94mABws2kMai', '2018-05-14 15:40:14', '2018-05-14 19:40:48', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
