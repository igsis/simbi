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

-- Copiando dados para a tabela simbi.acessibilidade_arquitetonicas:
DELETE FROM `acessibilidade_arquitetonicas`;
/*!40000 ALTER TABLE `acessibilidade_arquitetonicas` DISABLE KEYS */;
INSERT INTO `acessibilidade_arquitetonicas` (`id`, `acessibilidade_arquitetonica`) VALUES
  (1, 'Total'),
  (2, 'Parcial'),
  (3, 'Não Acessível');
/*!40000 ALTER TABLE `acessibilidade_arquitetonicas` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.contrato_usos:
DELETE FROM `contrato_usos`;
/*!40000 ALTER TABLE `contrato_usos` DISABLE KEYS */;
INSERT INTO `contrato_usos` (`id`, `contrato_uso`) VALUES
(1, 'Alugado'),
(2, 'Concessão de uso'),
(3, 'Próprio');
/*!40000 ALTER TABLE `contrato_usos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.distritos:
DELETE FROM `distritos`;
/*!40000 ALTER TABLE `distritos` DISABLE KEYS */;
INSERT INTO `distritos` (`id`, `descricao`) VALUES
(1, 'Água Rasa'),
(2, 'Alto de Pinheiros'),
(3, 'Anhanguera'),
(4, 'Aricanduva'),
(5, 'Artur Alvim'),
(6, 'Barra Funda'),
(7, 'Bela Vista'),
(8, 'Belém '),
(9, 'Bom Retiro'),
(10, 'Brás'),
(11, 'Brasilândia'),
(12, 'Cachoeirinha'),
(13, 'Cambuci'),
(14, 'Campo Belo'),
(15, 'Campo Grande'),
(16, 'Campo Limpo'),
(17, 'Cangaíba'),
(18, 'Capão Redondo'),
(19, 'Carrão'),
(20, 'Casa Verde'),
(21, 'Cidade Ademar'),
(22, 'Cidade Dutra'),
(23, 'Cidade Líder'),
(24, 'Cidade Tiradentes'),
(25, 'Consolação'),
(26, 'Cursino'),
(27, 'Ermelino Matarazzo'),
(28, 'Freguesia do Ó'),
(29, 'Grajaú'),
(30, 'Guaianazes'),
(31, 'Iguatemi'),
(32, 'Ipiranga'),
(33, 'Itaim Bibi'),
(34, 'Itaim Paulista'),
(35, 'Itaquera'),
(36, 'Jabaquara'),
(37, 'Jaçanã'),
(38, 'Jaguara'),
(39, 'Jaguaré'),
(40, 'Jaraguá'),
(41, 'Jardim Ângela'),
(42, 'Jardim Helena'),
(43, 'Jardim Paulista'),
(44, 'Jardim São Luís'),
(45, 'José Bonifácio'),
(46, 'Lajeado'),
(47, 'Lapa'),
(48, 'Liberdade'),
(49, 'Limão'),
(50, 'Mandaqui'),
(51, 'Marsilac'),
(52, 'Moema'),
(53, 'Mooca'),
(54, 'Morumbi'),
(55, 'Parelheiros'),
(56, 'Pari'),
(57, 'Parque do Carmo'),
(58, 'Pedreira'),
(59, 'Penha'),
(60, 'Perdizes'),
(61, 'Perus'),
(62, 'Pinheiros'),
(63, 'Pirituba'),
(64, 'Ponte Rasa'),
(65, 'Raposo Tavares'),
(66, 'República'),
(67, 'Rio Pequeno'),
(68, 'Sacomã'),
(69, 'Santa Cecília'),
(70, 'Santana'),
(71, 'Santo Amaro'),
(72, 'São Domingos'),
(73, 'São Lucas'),
(74, 'São Mateus'),
(75, 'São Miguel'),
(76, 'São Rafael'),
(77, 'Sapopemba'),
(78, 'Saúde'),
(79, 'Sé'),
(80, 'Socorro'),
(81, 'Tatuapé'),
(82, 'Tremembé'),
(83, 'Tucuruvi'),
(84, 'Vila Andrade'),
(85, 'Vila Curuçá'),
(86, 'Vila Formosa'),
(87, 'Vila Guilherme'),
(88, 'Vila Jacuí'),
(89, 'Vila Leopoldina'),
(90, 'Vila Maria'),
(91, 'Vila Mariana'),
(92, 'Vila Matilde'),
(93, 'Vila Medeiros'),
(94, 'Vila Prudente'),
(95, 'Vila Sônia'),
(96, 'Butantã');
/*!40000 ALTER TABLE `distritos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.enderecos: ~0 rows (aproximadamente)
DELETE FROM `enderecos`;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamentos: ~0 rows (aproximadamente)
DELETE FROM `equipamentos`;
/*!40000 ALTER TABLE `equipamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamentos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamento_padroes:
DELETE FROM `equipamento_padroes`;
/*!40000 ALTER TABLE `equipamento_padroes` DISABLE KEYS */;
INSERT INTO `equipamento_padroes` (`id`, `padrao`) VALUES
  (1, 'Jânio Novo'),
  (2, 'Jãnio Antigo');
/*!40000 ALTER TABLE `equipamento_padroes` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamento_portes:
DELETE FROM `equipamento_portes`;
/*!40000 ALTER TABLE `equipamento_portes` DISABLE KEYS */;
INSERT INTO `equipamento_portes` (`id`, `porte`) VALUES
  (1, 'Grande'),
  (2, 'Médio'),
  (3, 'Grande');
/*!40000 ALTER TABLE `equipamento_portes` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamentos_users: ~0 rows (aproximadamente)
DELETE FROM `equipamento_user`;
/*!40000 ALTER TABLE `equipamento_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamento_user` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamento_utilizacoes:
DELETE FROM `equipamento_utilizacoes`;
/*!40000 ALTER TABLE `equipamento_utilizacoes` DISABLE KEYS */;
INSERT INTO `equipamento_utilizacoes` (`id`, `utilizacao`) VALUES
  (1, 'Parcial'),
  (2, 'Total');
/*!40000 ALTER TABLE `equipamento_utilizacoes` ENABLE KEYS */;

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

-- Copiando dados para a tabela simbi.praca_classificacoes:
DELETE FROM `praca_classificacoes`;
/*!40000 ALTER TABLE `praca_classificacoes` DISABLE KEYS */;
INSERT INTO `praca_classificacoes` (`id`, `classificacao`) VALUES
  (1, 'Pequeno'),
  (2, 'Médio'),
  (3, 'Grande');
/*!40000 ALTER TABLE `praca_classificacoes` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.prefeitura_regionais: ~0 rows (aproximadamente)
DELETE FROM `prefeitura_regionais`;
/*!40000 ALTER TABLE `prefeitura_regionais` DISABLE KEYS */;
INSERT INTO `prefeitura_regionais` (`id`, `descricao`) VALUES
  (1, 'Aricanduva'),
  (2, 'Butantã'),
  (3, 'Campo Limpo'),
  (4, 'Capela do Socorro'),
  (5, 'Casa Verde'),
  (6, 'Cidade Ademar'),
  (7, 'Cidade Tiradentes'),
  (8, 'Ermelino Matarazzo'),
  (9, 'Freguesia do Ó'),
  (10, 'Guaianases'),
  (11, 'Ipiranga'),
  (12, 'Itaim Paulista'),
  (13, 'Itaquera'),
  (14, 'Jabaquara'),
  (15, 'Jaçanã'),
  (16, 'Lapa'),
  (17, 'M''Boi Mirim'),
  (18, 'Mooca'),
  (19, 'Parelheiros'),
  (20, 'Penha'),
  (21, 'Perus'),
  (22, 'Pinheiros'),
  (23, 'Pirituba'),
  (24, 'Santana'),
  (25, 'Santo Amaro'),
  (26, 'São Mateus'),
  (27, 'São Miguel'),
  (28, 'Sapopemba'),
  (29, 'Sé'),
  (30, 'Vila Maria/Vila Guilherme'),
  (31, 'Vila Mariana'),
  (32, 'Vila Prudente');
/*!40000 ALTER TABLE `prefeitura_regionais` ENABLE KEYS */;

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
	(3, 'Funcionário', 'web', '2018-05-11 16:05:19', '2018-05-11 16:05:19');
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

-- Copiando dados para a tabela simbi.status:
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
INSERT INTO `users` (`id`, `name`, `login`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `publicado`) VALUES
	(1, 'Admin', '0000000', 'admin@teste.com', '$2y$10$QTa2XVi7nGlNvIyZiF7IGutDOPMQTwBm.3vpKB61Ly77oLnJ.rXyu', 'ftruU1O8HmmfGW11XhoQkAmZmPFPauSzOVlpGAvtkeDeN2F6A4b720xNZLb2', '2018-05-11 15:59:01', '2018-05-11 15:59:01', 1),
	(2, 'Coordenador', '1111111', 'coordenador@teste.com.br', '$2y$10$7bQhXdsh5jdE6V6UuA9geOEg4vbMrRo/rFeEY.riwU5nDaws9tR9y', '0P9HnMF5YjfeoKLejOd6uDc4N4jTDfhiS0e9FFyIkJW1ukM35EPoQVWZnYTg', '2018-05-14 15:06:45', '2018-05-14 15:06:45', 1),
	(3, 'Funcionario', '2222222', 'func@teste.com.br', '$2y$10$AW7Mggvjj/HArXAjpyhAN.Z3ehFnVOkBxVofknq1iuAHoR667.ElC', 'kIoobYgkEjLcxSJVqzYvdadvgkfoLum7gOpMpr0eedJjZx3m94mABws2kMai', '2018-05-14 15:40:14', '2018-05-14 19:40:48', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
