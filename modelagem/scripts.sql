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

-- Copiando dados para a tabela simbi.roles:
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
	INSERT INTO `simbi`.`roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES 
    (1, 'Administrador', 'web', '2018-05-11 16:04:58', '2018-05-11 16:04:58');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.model_has_roles:
DELETE FROM `model_has_roles`;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
	(1, 1, 'Simbi\\Models\\User'),
	(2, 2, 'Simbi\\Models\\User'),
	(3, 3, 'Simbi\\Models\\User');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.role_has_permissions:
DELETE FROM `role_has_permissions`;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(2, 2),
	(3, 2),
	(3, 3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

DELETE FROM `responsabilidade_tipos`;
/*!40000 ALTER TABLE `responsabilidade_tipos` DISABLE KEYS */;
INSERT INTO `responsabilidade_tipos` (`id`, `responsabilidade_tipo`) VALUES
(1, 'Funcionario'),
(2, 'Coordenador'),
(3, 'Coordenador Substituto');
/*!40000 ALTER TABLE `responsabilidade_tipos` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` (`id`, `cargo`, `publicado`) VALUES
(1, 'Chefe',1),
(2, 'Estagiário',1);
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.enderecos: ~0 rows (aproximadamente)
DELETE FROM `enderecos`;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;


DELETE FROM `elevadores`;
/*!40000 ALTER TABLE `elevadores` DISABLE KEYS */;
INSERT INTO `simbi`.`elevadores` (`id`, `elevador`) VALUES 
(1, 'Não'), 
(2, 'Sim'), 
(3, 'Sim, porém em manutenção');
/*!40000 ALTER TABLE `elevadores` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamentos: ~0 rows (aproximadamente)
/*DELETE FROM `escolaridades`;
!40000 ALTER TABLE `escolaridades` DISABLE KEYS 
INSERT INTO escolaridades (id, escolaridade) VALUES
(1, 'Fundamental'),
(2, 'Médio'),
(3, 'Superior Incompleto'),
(4, 'Superior Completo'),
(5, 'Pós Graduação'),
(6, 'Mestrado'),
(7, 'Doutorado');
/*!40000 ALTER TABLE `escolaridades` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamentos: ~0 rows (aproximadamente)
DELETE FROM `equipamentos`;
/*!40000 ALTER TABLE `equipamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamentos` ENABLE KEYS */;

DELETE FROM `dia_semanas`;
/*!40000 ALTER TABLE `dia_semanas` DISABLE KEYS */;
INSERT INTO `dia_semanas` (`id`, `dia`) VALUES
	(1, 'Domingo'),
    (2, 'Segunda'),
    (3, 'Terça'),
    (4, 'Quarta'),
    (5, 'Quinta'),
    (6, 'Sexta'),
    (7, 'Sábado');
/*!40000 ALTER TABLE `dia_semanas` ENABLE KEYS */;


-- Copiando dados para a tabela simbi.padroes:
DELETE FROM `padroes`;
/*!40000 ALTER TABLE `padroes` DISABLE KEYS */;
INSERT INTO `padroes` (`id`, `padrao`) VALUES
  (1, 'Jânio Novo'),
  (2, 'Jãnio Antigo');
/*!40000 ALTER TABLE `padroes` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.portes:
DELETE FROM `portes`;
/*!40000 ALTER TABLE `portes` DISABLE KEYS */;
INSERT INTO `portes` (`id`, `porte`) VALUES
  (1, 'Pequeno'),
  (2, 'Médio'),
  (3, 'Grande');
/*!40000 ALTER TABLE `portes` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.utilizacoes:
DELETE FROM `utilizacoes`;
/*!40000 ALTER TABLE `utilizacoes` DISABLE KEYS */;
INSERT INTO `utilizacoes` (`id`, `utilizacao`) VALUES
  (1, 'Parcial'),
  (2, 'Total');
/*!40000 ALTER TABLE `utilizacoes` ENABLE KEYS */;


-- Copiando dados para a tabela simbi.macrorregiao: ~0 rows (aproximadamente)
DELETE FROM `macrorregioes`;
/*!40000 ALTER TABLE `macrorregioes` DISABLE KEYS */;
INSERT INTO `macrorregioes` (`id`, `descricao`) VALUES
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
/*!40000 ALTER TABLE `macrorregioes` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.migrations: ~0 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

DELETE FROM `projeto_especiais`;
/*!40000 ALTER TABLE `projeto_especiais` DISABLE KEYS */;

 INSERT INTO `projeto_especiais` (`id`,`projeto_especial`,`publicado`) VALUES
	(1,'* Não pertence a nenhum projeto especial',1),
	(2,'Mês da Cultura Independente (MCI)',1),
	(3,'50 anos do golpe',1),
	(4,'Edital Programa de Exposições CCSP',1),
	(5,'Edital de Mediação em Arte',1),
	(6,'Edital ccsp dança em site específico',1),
	(7,'Aniversário do CCSP',1),
	(8,'Semanas de Dança',1),
	(9,'Mostra de Fomento',1),
	(10,'Outubro Mês da Criança ',1),
	(11,'Livre Acesso',1),
	(12,'Circuito Cultural',1),
	(13,'Circuito Municipal de Cultura 2016',1),
	(14,'Aniversário da Cidade de São Paulo 2016',1),
	(15,'Carnaval 2016',1),
	(16,'FunkSP',1),
	(17,'Programação do Museu da Cidade ',1),
	(18,'LIVRE ACESSO',0),
	(19,'Circuito Municipal de Cultura 2016 / Ruas Abertas',0),
	(20,'Vitrine da Dança ',1),
	(21,'Choro no Mercadão',1),
	(22,'A Hora do Choro',1),
	(23,'Virada Cultural 2016',1),
	(24,'Virada Cultural 2016 e Circuito Municipal de Cultura 2016',1),
	(25,'Programa Veia e Ventania',1),
	(26,'Edital Ocupação Folhetaria ',1),
	(27,'Ateliê Sonoro CCSP',1),
	(28,'Aniversário EMIA - 35 anos',1),
	(29,'Circuito Municipal de Cultura 2016 / Mostra [D]escontructo',1),
	(30,'Emenda Parlamentar',1),
	(31,'Jornada do Patrimônio',1),
	(32,'XII FESTIVAL A ARTE DE CONTAR HISTÓRIAS',1),
	(33,'Território Hip Hop',1),
	(35,'Arte&Sexualidade',1),
	(36,'II Feira de Arte Impressa',0),
	(37,'Exposição Mostra Folhetaria - Segunda Edição',0),
	(38,'II Feira de Arte Impressa do CCSP e Exposição Mostra Folhetaria',1),
	(39,'Aniversário da Cidade de São Paulo 2017',1),
	(41,'Virada Cultural 2017',1),
	(42,'Semana Márioswald - Cem anos de uma amizade',1),
	(43,'Biblioteca Viva',1),
	(44,'Curso de Formação para Funcionários',1),
	(45,'Mês do Hip Hop',1),
	(46,'Edital da Mostra de Dramaturgia em Pequenos Formatos Cênicos',1),
	(47,'Mês do Rock',1),
	(48,'Quintas da Boa Música',1),
	(49,'Gala de Balé',1),
	(50,'70 +',0),
	(51,'XIII FESTIVAL A ARTE DE CONTAR HISTÓRIAS',1),
	(52,'Mês do Samba',1),
	(53,'Guimarães Rosa',1),
	(54,'Virada Cultural 2018',1),
	(55,'Aniversário da Cidade de São Paulo 2018',1),
	(56,'Abril Para a Dança',1),
	(57,'Explosão 68',1),
	(58,'De Palco em Palco',1),
	(59,'Criançada',1),
	(60,'Giro da Cultura',1),
	(61,'Edital de Seleção de Oficineiros 2017 CCSP',1),
	(62,'Peripatumen – Conversas Filosóficas para Crianças',1),
	(63,'80 anos da Missão de Pesquisas Folclóricas de Mário de Andrade',1),
	(64,'CUCA',1),
	(65,'Edital de Credenciamento nº 01/2017 – SMC/GAB',1);

/*!40000 ALTER TABLE `projeto_especiais` ENABLE KEYS */;

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

-- Copiando dados para a tabela simbi.classificacoes:
DELETE FROM `classificacoes`;
/*!40000 ALTER TABLE `classificacoes` DISABLE KEYS */;
INSERT INTO `classificacoes` (`id`, `classificacao`) VALUES
  (1, 'Pequeno'),
  (2, 'Médio'),
  (3, 'Grande');
/*!40000 ALTER TABLE `classificacoes` ENABLE KEYS */;

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
DELETE FROM `regioes`;
/*!40000 ALTER TABLE `regioes` DISABLE KEYS */;
INSERT INTO `regioes` (`id`, `descricao`) VALUES
	(1, 'Norte'),
	(2, 'Sul'),
	(3, 'Leste'),
	(4, 'Oeste'),
	(5, 'Centro');
/*!40000 ALTER TABLE `regioes` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.regional: ~0 rows (aproximadamente)
DELETE FROM `regionais`;
/*!40000 ALTER TABLE `regionais` DISABLE KEYS */;
INSERT INTO `regionais` (`id`, `descricao`) VALUES
	(1, 'Norte'),
	(2, 'Sul'),
	(3, 'Leste 1'),
	(4, 'Leste 2'),
	(5, 'Oeste'),
	(6, 'Centro');
/*!40000 ALTER TABLE `regionais` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.secretarias: ~0 rows (aproximadamente)
DELETE FROM `secretarias`;
/*!40000 ALTER TABLE `secretarias` DISABLE KEYS */;
INSERT INTO `secretarias` (`id`,`sigla`,`descricao`,`publicado`) VALUES
		(1,'SMC','Secretaria Municipal de Cultura',1),
        (2,'SMS','Secretaria Municipal de Saúde',1);
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

DELETE FROM `tipo_eventos`;
/*!40000 ALTER TABLE `tipo_eventos` DISABLE KEYS */;
INSERT INTO `simbi`.`tipo_eventos` (`id`, `tipo_evento`, `publicado`) VALUES 
	(1, 'Mostra de Cinema', 1),
	(2, 'Exposição', 1),
	(3, 'Espetáculo de dança', 1),
	(4, 'Oficinas', 1),
	(5, 'Palestras e debates', 1),
	(6, 'Recital de poesia e literatura', 1),
	(7, 'Espetáculo teatral', 1),
	(8, 'Contação de histórias', 1),
	(9, 'Teatro infanto-juvenil', 0),
	(10, 'Sarau', 1),
	(11, 'Concerto', 1),
	(12, 'Espetáculo Musical / Show', 1),
	(13, 'Outros', 0),
	(14, 'Teatro Adulto', 0),
	(15, 'Leitura dramática', 1),
	(16, 'Espetáculo de Circo', 1),
	(18, 'Transmissão online', 1),
	(19, 'Show infanto-juvenil', 0),
	(20, 'Performance', 1),
	(21, 'JAM', 1),
	(22, 'Intervenção Visual', 1),
	(23, 'Intervenção Artística', 1),
	(24, 'Cinema em Cartaz', 1),
	(25, 'Ocupação', 1),
	(26, 'Curadoria', 1),
	(27, 'Mostra de Teatro', 1),
	(29, 'Espetáculo Infantil ', 1),
	(31, 'Brincante ', 0),
	(32, 'Participação como membro de comissão de seleção', 1),
	(34, 'Workshop', 1),
	(35, 'Visitas', 1),
	(36, 'Mostra de Dança', 1),
	(37, 'Teatro para bebes', 1);
/*!40000 ALTER TABLE `tipo_eventos` ENABLE KEYS */;

DELETE FROM `contratacao_formas`;
/*!40000 ALTER TABLE `contratacao_formas` DISABLE KEYS */;
INSERT INTO `simbi`.`contratacao_formas` (`id`, `forma_contratacao`) VALUES
	(1, 'Pago'),
    (2, 'Voluntário');
/*!40000 ALTER TABLE `contratacao_formas` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.tipo_servicos: ~0 rows (aproximadamente)
DELETE FROM `tipo_servicos`;
/*!40000 ALTER TABLE `tipo_servicos` DISABLE KEYS */;
INSERT INTO `tipo_servicos` (`id`, `descricao`) VALUES
	(1, 'Bibliotecas CSMB'),
	(2, 'Bosque da Leitura'),
	(3, 'Ponto de Leitura'),
	(4, 'Ônibus Biblioteca'),
	(5, 'Caixa / Estante'),
	(6, 'Feira de Troca');
/*!40000 ALTER TABLE `tipo_servicos` ENABLE KEYS */;


-- Copiando dados para a tabela simbi.area_eventos:
DELETE FROM `area_eventos`;
/*!40000 ALTER TABLE `area_eventos` DISABLE KEYS */;
INSERT INTO `area_eventos` (`id`, `area`) VALUES
  (1, 'Interna'),
  (2, 'Externa');
/*!40000 ALTER TABLE `utilizacoes` ENABLE KEYS */;


/*!40000 ALTER TABLE `nivel_acessos` DISABLE KEYS */;
INSERT INTO `nivel_acessos` (`id`, `nivel_acesso`) VALUES
	(1, 'Administrativo'),
    (2, 'Coordenador'),
    (3,'Funcionário');
/*!40000 ALTER TABLE `nivel_acessos` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.funcionarios: 1~ rows (aproximadamente)
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` (`id`, `nome`, `cargo_id`, `tipo_pessoa`, `publicado`) VALUES
	(1, 'Diego' ,1, 1, 2);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;


/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `publicado`,`funcionario_id`,`nivel_acesso_id`) VALUES
	(1, '0000000', 'teste@teste.com', '$2y$10$QTa2XVi7nGlNvIyZiF7IGutDOPMQTwBm.3vpKB61Ly77oLnJ.rXyu', 'ftruU1O8HmmfGW11XhoQkAmZmPFPauSzOVlpGAvtkeDeN2F6A4b720xNZLb2', '2018-05-11 15:59:01', '2018-05-11 15:59:01', 1, 1, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

SET lc_time_names = 'pt_BR';

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
