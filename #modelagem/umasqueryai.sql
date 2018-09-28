drop database simbi;

use igsis;

SELECT DISTINCT evento.idEvento as igsis_id, 
evento.nomeEvento as nome_evento, 
evento.ig_tipo_evento_idTipoEvento as tipo_evento_id, 
evento.projetoEspecial as projeto_especial_id, 
evento.publicado 
FROM ig_evento as evento 
INNER JOIN igsis_agenda as agenda ON 
agenda.idEvento = evento.idEvento 
WHERE agenda.data > '2018-09-01' 
AND agenda.idInstituicao = 14;

SELECT agenda.idEvento as igsis_evento_id,
agenda.idLocal as igsis_id,
agenda.data as data,
agenda.hora as horario
FROM igsis_agenda as agenda
WHERE agenda.idInstituicao = 14
AND agenda.data > '2018-09-01';

use simbi;

INSERT INTO `eventos` (`igsis_evento_id`,`nome_evento`,`tipo_evento_id`,`projeto_especial_id`,`publicado`) VALUES
	(11778,'Oficina de Capoeira - Biblioteca Menotti Del Picchia ',4,43,1),
	(11790,'Oficina de Dança Moderna e Improvisação ',4,43,1),
	(12037,'oficina  A teatralidade no contos de Marcelino Freire nas Bibliotecas',4,43,1),
	(11999,'Oficina de Amigurumi - Crochê 3D - Biblioteca Raul Bopp',4,43,1),
	(12228,'Oficina: Origami Lúdico',4,1,1),
	(12224,'Oficina: Musicoterapia em Ação',4,1,1),
	(12391,'Oficina de desenho e animação',4,1,1),
	(12210,'Oficina de Patchwork',4,1,1),
	(12548,'Oficina de Dança com Carlos Eduardo de Oliveira Pinto nas Bibliotecas',4,43,1),
	(12183,'Oficina Dançar é Escrever com o Corpo',4,43,1),
	(14005,'Toró Instrumental - Pocket Show',12,43,1),
	(14030,'Contos Russos - Girasonhos',8,43,1),
	(14035,'Contos Russos',8,43,1),
	(14049,'Karla da Silva',12,43,1);

INSERT INTO `evento_ocorrencias` (`igsis_evento_id`,`igsis_id`,`data`,`horario`) VALUES 
	(11778,108,'2018-09-06','15:00:00'),
	(11778,108,'2018-09-13','15:00:00'),
	(11778,108,'2018-09-20','15:00:00'),
	(11778,108,'2018-09-27','15:00:00'),
	(11778,108,'2018-10-04','15:00:00'),
	(11778,108,'2018-10-11','15:00:00'),
	(11778,108,'2018-10-18','15:00:00'),
	(11778,108,'2018-10-25','15:00:00'),
	(11778,108,'2018-11-01','15:00:00'),
	(11778,108,'2018-11-08','15:00:00'),
	(11778,108,'2018-11-15','15:00:00'),
	(11778,108,'2018-11-22','15:00:00'),
	(11778,108,'2018-11-29','15:00:00'),
	(11778,108,'2018-12-06','15:00:00'),
	(11778,108,'2018-12-13','15:00:00'),
	(11778,108,'2018-12-20','15:00:00'),
	(11790,80,'2018-09-04','19:00:00'),
	(11790,80,'2018-09-11','19:00:00'),
	(11790,80,'2018-09-18','19:00:00'),
	(11790,80,'2018-09-25','19:00:00'),
	(11790,80,'2018-10-02','19:00:00'),
	(11790,80,'2018-10-09','19:00:00'),
	(11790,80,'2018-10-16','19:00:00'),
	(11790,80,'2018-10-23','19:00:00'),
	(11790,80,'2018-10-30','19:00:00'),
	(11790,80,'2018-11-06','19:00:00'),
	(11790,80,'2018-11-13','19:00:00'),
	(12037,80,'2018-09-03','19:00:00'),
	(12037,80,'2018-09-10','19:00:00'),
	(12037,80,'2018-09-17','19:00:00'),
	(12037,80,'2018-09-24','19:00:00'),
	(12037,80,'2018-10-01','19:00:00'),
	(12037,80,'2018-10-08','19:00:00'),
	(11999,119,'2018-09-05','14:00:00'),
	(11999,119,'2018-09-12','14:00:00'),
	(11999,119,'2018-09-19','14:00:00'),
	(11999,119,'2018-09-26','14:00:00'),
	(11999,119,'2018-10-03','14:00:00'),
	(11999,119,'2018-10-10','14:00:00'),
	(12228,129,'2018-09-05','10:00:00'),
	(12228,129,'2018-09-12','10:00:00'),
	(12228,129,'2018-09-19','10:00:00'),
	(12228,129,'2018-09-26','10:00:00'),
	(12228,129,'2018-10-03','10:00:00'),
	(12228,129,'2018-10-10','10:00:00'),
	(12228,129,'2018-10-17','10:00:00'),
	(12228,129,'2018-10-24','10:00:00'),
	(12228,129,'2018-10-31','10:00:00'),
	(12228,129,'2018-11-07','10:00:00'),
	(12228,129,'2018-11-14','10:00:00'),
	(12228,129,'2018-11-21','10:00:00'),
	(12228,129,'2018-11-28','10:00:00'),
	(12228,129,'2018-12-05','10:00:00'),
	(12228,129,'2018-12-12','10:00:00'),
	(12228,129,'2018-12-19','10:00:00'),
	(12224,95,'2018-09-02','10:00:00'),
	(12224,95,'2018-09-03','10:00:00'),
	(12224,95,'2018-09-04','10:00:00'),
	(12224,95,'2018-09-05','10:00:00'),
	(12224,95,'2018-09-06','10:00:00'),
	(12224,95,'2018-09-07','10:00:00'),
	(12224,95,'2018-09-08','10:00:00'),
	(12224,95,'2018-09-09','10:00:00'),
	(12224,95,'2018-09-10','10:00:00'),
	(12224,95,'2018-09-11','10:00:00'),
	(12224,95,'2018-09-12','10:00:00'),
	(12224,95,'2018-09-13','10:00:00'),
	(12224,95,'2018-09-14','10:00:00'),
	(12224,95,'2018-09-15','10:00:00'),
	(12224,95,'2018-09-16','10:00:00'),
	(12224,95,'2018-09-17','10:00:00'),
	(12224,95,'2018-09-18','10:00:00'),
	(12224,95,'2018-09-19','10:00:00'),
	(12224,95,'2018-09-20','10:00:00'),
	(12224,95,'2018-09-21','10:00:00'),
	(12224,95,'2018-09-22','10:00:00'),
	(12224,95,'2018-09-23','10:00:00'),
	(12224,95,'2018-09-24','10:00:00'),
	(12224,95,'2018-09-25','10:00:00'),
	(12224,95,'2018-09-26','10:00:00'),
	(12224,95,'2018-09-27','10:00:00'),
	(12224,95,'2018-09-28','10:00:00'),
	(12224,95,'2018-09-29','10:00:00'),
	(12224,95,'2018-09-30','10:00:00'),
	(12224,95,'2018-10-01','10:00:00'),
	(12224,95,'2018-10-02','10:00:00'),
	(12224,95,'2018-10-03','10:00:00'),
	(12224,95,'2018-10-04','10:00:00'),
	(12224,95,'2018-10-05','10:00:00'),
	(12224,95,'2018-10-06','10:00:00'),
	(12224,95,'2018-10-07','10:00:00'),
	(12224,95,'2018-10-08','10:00:00'),
	(12224,95,'2018-10-09','10:00:00'),
	(12224,95,'2018-10-10','10:00:00'),
	(12224,95,'2018-10-11','10:00:00'),
	(12224,95,'2018-10-12','10:00:00'),
	(12224,95,'2018-10-13','10:00:00'),
	(12224,95,'2018-10-14','10:00:00'),
	(12224,95,'2018-10-15','10:00:00'),
	(12224,95,'2018-10-16','10:00:00'),
	(12224,95,'2018-10-17','10:00:00'),
	(12224,95,'2018-10-18','10:00:00'),
	(12391,96,'2018-09-03','14:30:00'),
	(12391,96,'2018-09-10','14:30:00'),
	(12391,96,'2018-09-17','14:30:00'),
	(12391,96,'2018-09-24','14:30:00'),
	(12391,96,'2018-10-01','14:30:00'),
	(12391,96,'2018-10-08','14:30:00'),
	(12391,96,'2018-10-15','14:30:00'),
	(12391,96,'2018-10-22','14:30:00'),
	(12391,96,'2018-10-29','14:30:00'),
	(12391,96,'2018-11-05','14:30:00'),
	(12391,96,'2018-11-12','14:30:00'),
	(12391,96,'2018-11-19','14:30:00'),
	(12391,96,'2018-11-26','14:30:00'),
	(12210,124,'2018-09-02','14:30:00'),
	(12210,124,'2018-09-03','14:30:00'),
	(12210,124,'2018-09-04','14:30:00'),
	(12210,124,'2018-09-05','14:30:00'),
	(12210,76,'2018-09-06','14:00:00'),
	(12210,76,'2018-09-13','14:00:00'),
	(12210,76,'2018-09-20','14:00:00'),
	(12210,76,'2018-09-27','14:00:00'),
	(12210,76,'2018-10-04','14:00:00'),
	(12210,76,'2018-10-11','14:00:00'),
	(12210,76,'2018-10-18','14:00:00'),
	(12210,76,'2018-10-25','14:00:00'),
	(12210,76,'2018-11-01','14:00:00'),
	(12548,95,'2018-09-07','09:00:00'),
	(12548,95,'2018-09-14','09:00:00'),
	(12548,95,'2018-09-21','09:00:00'),
	(12548,95,'2018-09-28','09:00:00'),
	(12548,95,'2018-10-05','09:00:00'),
	(12548,95,'2018-10-12','09:00:00'),
	(12548,95,'2018-10-19','09:00:00'),
	(12548,95,'2018-10-26','09:00:00'),
	(12183,95,'2018-09-03','09:00:00'),
	(12183,95,'2018-09-10','09:00:00'),
	(12183,95,'2018-09-17','09:00:00'),
	(12183,95,'2018-09-24','09:00:00'),
	(14005,87,'2018-09-25','14:30:00'),
	(14005,95,'2018-09-26','10:00:00'),
	(14030,77,'2018-09-14','09:30:00'),
	(14035,77,'2018-09-14','09:30:00'),
	(14049,88,'2018-09-19','14:30:00'),
	(14049,129,'2018-09-22','15:00:00');
