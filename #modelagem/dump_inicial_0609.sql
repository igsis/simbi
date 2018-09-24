-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema simbi
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `simbi` DEFAULT CHARACTER SET utf8 ;
USE `simbi` ;

-- -----------------------------------------------------
-- Table `simbi`.`distritos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`distritos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  `publicado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`macrorregiao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`macrorregiao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`regiao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`regiao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`regional`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`regional` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`prefeitura_regionais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`prefeitura_regionais` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  `publicado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`enderecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`enderecos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cep` VARCHAR(10) NOT NULL,
  `logradouro` VARCHAR(255) NOT NULL,
  `numero` INT(10) NOT NULL,
  `complemento` VARCHAR(100) NULL DEFAULT NULL,
  `bairro` VARCHAR(50) NOT NULL,
  `cidade` VARCHAR(50) NOT NULL,
  `estado` VARCHAR(2) NOT NULL,
  `prefeitura_regional_id` INT NULL,
  `distrito_id` INT NULL,
  `macrorregiao_id` INT NULL,
  `regiao_id` INT NULL,
  `regional_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `endereco_subprefeitura_fk_idx` (`prefeitura_regional_id` ASC),
  INDEX `endereco_distrito_fk_idx` (`distrito_id` ASC),
  INDEX `endereco_macrorregiao_fk_idx` (`macrorregiao_id` ASC),
  INDEX `endereco_regiao_fk_idx` (`regiao_id` ASC),
  INDEX `endereco_regional_fk_idx` (`regional_id` ASC),
  CONSTRAINT `endereco_distrito_fk`
    FOREIGN KEY (`distrito_id`)
    REFERENCES `simbi`.`distritos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `endereco_macrorregiao_fk`
    FOREIGN KEY (`macrorregiao_id`)
    REFERENCES `simbi`.`macrorregiao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `endereco_regiao_fk`
    FOREIGN KEY (`regiao_id`)
    REFERENCES `simbi`.`regiao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `endereco_regional_fk`
    FOREIGN KEY (`regional_id`)
    REFERENCES `simbi`.`regional` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `endereco_subprefeitura_fk`
    FOREIGN KEY (`prefeitura_regional_id`)
    REFERENCES `simbi`.`prefeitura_regionais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`equipamento_siglas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`equipamento_siglas` (
  `id` TINYINT(2) NOT NULL AUTO_INCREMENT,
  `sigla` VARCHAR(6) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `roteiro` LONGTEXT NULL DEFAULT NULL,
  `publicado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`secretarias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`secretarias` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `sigla` VARCHAR(6) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `publicado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`status` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`subordinacao_administrativas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`subordinacao_administrativas` (
  `id` TINYINT(2) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  `publicado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`tipo_servicos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`tipo_servicos` (
  `id` TINYINT(2) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  `publicado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`equipamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`equipamentos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `tipo_servico_id` TINYINT(2) NOT NULL,
  `equipamento_sigla_id` TINYINT(2) NOT NULL,
  `secretaria_id` TINYINT(1) NOT NULL,
  `subordinacao_administrativa_id` TINYINT(2) NOT NULL,
  `tematico` TINYINT(1) NOT NULL DEFAULT 0,
  `nome_tematica` VARCHAR(100) NULL DEFAULT NULL,
  `endereco_id` INT NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `telecentro` TINYINT(1) NOT NULL DEFAULT 0,
  `acervo_especializado` TINYINT(1) NOT NULL DEFAULT 0,
  `nucleo_braile` TINYINT(1) NOT NULL DEFAULT 0,
  `status_id` TINYINT(1) NOT NULL,
  `observacao` VARCHAR(170) NULL DEFAULT NULL,
  `publicado` TINYINT(1) NOT NULL DEFAULT 1,
  `portaria` INT NOT NULL DEFAULT 0 COMMENT '0 = portaria normal\n1 = portaria completa',
  PRIMARY KEY (`id`),
  INDEX `equipamento_tipoServico_fk_idx` (`tipo_servico_id` ASC),
  INDEX `equipamento_equipamentoSigla_fk_idx` (`equipamento_sigla_id` ASC),
  INDEX `equipamento_secretaria_fk_idx` (`secretaria_id` ASC),
  INDEX `equipamento_subAdministrativa_fk_idx` (`subordinacao_administrativa_id` ASC),
  INDEX `equipamento_status_fk_idx` (`status_id` ASC),
  INDEX `equipamento_endereco_fk_idx` (`endereco_id` ASC),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  CONSTRAINT `equipamento_equipamentoSigla_fk`
    FOREIGN KEY (`equipamento_sigla_id`)
    REFERENCES `simbi`.`equipamento_siglas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `equipamento_secretaria_fk`
    FOREIGN KEY (`secretaria_id`)
    REFERENCES `simbi`.`secretarias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `equipamento_status_fk`
    FOREIGN KEY (`status_id`)
    REFERENCES `simbi`.`status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `equipamento_subAdministrativa_fk`
    FOREIGN KEY (`subordinacao_administrativa_id`)
    REFERENCES `simbi`.`subordinacao_administrativas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `equipamento_tipoServico_fk`
    FOREIGN KEY (`tipo_servico_id`)
    REFERENCES `simbi`.`tipo_servicos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `equipamento_endereco_fk`
    FOREIGN KEY (`endereco_id`)
    REFERENCES `simbi`.`enderecos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simbi`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `simbi`.`permissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`permissions` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `guard_name` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `simbi`.`model_has_permissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`model_has_permissions` (
  `permission_id` INT(10) UNSIGNED NOT NULL,
  `model_id` INT(10) UNSIGNED NOT NULL,
  `model_type` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
  INDEX `model_has_permissions_model_id_model_type_index` (`model_id` ASC, `model_type` ASC),
  CONSTRAINT `model_has_permissions_permission_id_foreign`
    FOREIGN KEY (`permission_id`)
    REFERENCES `simbi`.`permissions` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `simbi`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`roles` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `guard_name` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `simbi`.`model_has_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`model_has_roles` (
  `role_id` INT(10) UNSIGNED NOT NULL,
  `model_id` INT(10) UNSIGNED NOT NULL,
  `model_type` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`),
  INDEX `model_has_roles_model_id_model_type_index` (`model_id` ASC, `model_type` ASC),
  CONSTRAINT `model_has_roles_role_id_foreign`
    FOREIGN KEY (`role_id`)
    REFERENCES `simbi`.`roles` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `simbi`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`password_resets` (
  `email` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `token` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `simbi`.`role_has_permissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`role_has_permissions` (
  `permission_id` INT(10) UNSIGNED NOT NULL,
  `role_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`),
  INDEX `role_has_permissions_role_id_foreign` (`role_id` ASC),
  CONSTRAINT `role_has_permissions_permission_id_foreign`
    FOREIGN KEY (`permission_id`)
    REFERENCES `simbi`.`permissions` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign`
    FOREIGN KEY (`role_id`)
    REFERENCES `simbi`.`roles` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `simbi`.`pergunta_segurancas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`pergunta_segurancas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pergunta_seguranca` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`cargos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`cargos` (
  `id` TINYINT(2) NOT NULL AUTO_INCREMENT,
  `cargo` VARCHAR(60) NOT NULL,
  `publicado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`funcoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`funcoes` (
  `id` TINYINT(2) NOT NULL AUTO_INCREMENT,
  `funcao` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`escolaridades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`escolaridades` (
  `id` TINYINT(2) NOT NULL AUTO_INCREMENT,
  `escolaridade` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `login` VARCHAR(7) NOT NULL,
  `email` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `password` VARCHAR(191) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `remember_token` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `pergunta_seguranca_id` INT NULL,
  `resposta_seguranca` VARCHAR(25) NULL DEFAULT NULL,
  `cargo_id` TINYINT(2) NULL,
  `funcao_id` TINYINT(2) NULL,
  `escolaridade_id` TINYINT(2) NULL,
  `previsao_aposentadoria` DATE NULL,
  `secretaria_id` TINYINT(1) NULL,
  `subordinacao_administrativa_id` TINYINT(2) NULL,
  `publicado` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `user_perguntaSecreta_fk_idx` (`pergunta_seguranca_id` ASC),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  INDEX `fk_users_cargos_idx` (`cargo_id` ASC),
  INDEX `fk_users_funcoes_id_idx` (`funcao_id` ASC),
  INDEX `fk_users_escolaridades_idx` (`escolaridade_id` ASC),
  INDEX `fk_users_secretarias_idx` (`secretaria_id` ASC),
  INDEX `fk_users_subordinacao_administrativas_idx` (`subordinacao_administrativa_id` ASC),
  CONSTRAINT `user_perguntaSecreta_fk`
    FOREIGN KEY (`pergunta_seguranca_id`)
    REFERENCES `simbi`.`pergunta_segurancas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_cargos`
    FOREIGN KEY (`cargo_id`)
    REFERENCES `simbi`.`cargos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_funcoes_id`
    FOREIGN KEY (`funcao_id`)
    REFERENCES `simbi`.`funcoes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_escolaridades`
    FOREIGN KEY (`escolaridade_id`)
    REFERENCES `simbi`.`escolaridades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_secretarias`
    FOREIGN KEY (`secretaria_id`)
    REFERENCES `simbi`.`secretarias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_subordinacao_administrativas`
    FOREIGN KEY (`subordinacao_administrativa_id`)
    REFERENCES `simbi`.`subordinacao_administrativas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `simbi`.`responsabilidade_tipos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`responsabilidade_tipos` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `responsabilidade_tipo` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`equipamento_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`equipamento_user` (
  `equipamento_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `data_inicio` DATE NULL,
  `data_fim` DATE NULL DEFAULT NULL,
  `responsabilidade_tipo_id` TINYINT(1) NULL,
  INDEX `users_equipamentos_fk_idx` (`user_id` ASC),
  PRIMARY KEY (`equipamento_id`, `user_id`),
  INDEX `fk_equipamento_user_responsabilidade_tipos_idx` (`responsabilidade_tipo_id` ASC),
  CONSTRAINT `equipamentos_users_fk`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `users_equipamentos_fk`
    FOREIGN KEY (`user_id`)
    REFERENCES `simbi`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipamento_user_responsabilidade_tipos`
    FOREIGN KEY (`responsabilidade_tipo_id`)
    REFERENCES `simbi`.`responsabilidade_tipos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`funcionamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`funcionamentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `equipamento_id` INT NOT NULL,
  `segunda` TINYINT(1) NULL DEFAULT 0,
  `terca` TINYINT(1) NULL DEFAULT 0,
  `quarta` TINYINT(1) NULL DEFAULT 0,
  `quinta` TINYINT(1) NULL DEFAULT 0,
  `sexta` TINYINT(1) NULL DEFAULT 0,
  `sabado` TINYINT(1) NULL DEFAULT 0,
  `domingo` TINYINT(1) NULL DEFAULT 0,
  `hora_inicial` TIME NOT NULL,
  `hora_final` TIME NOT NULL,
  `publicado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `funcionamento_equipamento_fk_idx` (`equipamento_id` ASC),
  CONSTRAINT `funcionamento_equipamento_fk`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`equipamento_ocorrencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`equipamento_ocorrencias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `equipamento_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `data` DATE NOT NULL,
  `ocorrencia` VARCHAR(255) NOT NULL,
  `observacao` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_equipamento_ocorrencias_equipamentos_idx` (`equipamento_id` ASC),
  INDEX `fk_equipamento_ocorrencias_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_equipamento_ocorrencias_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipamento_ocorrencias_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `simbi`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`legislacao_tipos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`legislacao_tipos` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `legislacao_tipo` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`legislacoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`legislacoes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `legislacao_tipo_id` TINYINT(1) NOT NULL,
  `numero` VARCHAR(50) NOT NULL,
  `ementa` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_legislacoes_legislacao_tipos_idx` (`legislacao_tipo_id` ASC),
  CONSTRAINT `fk_legislacoes_legislacao_tipos`
    FOREIGN KEY (`legislacao_tipo_id`)
    REFERENCES `simbi`.`legislacao_tipos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`equipamento_legislacoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`equipamento_legislacoes` (
  `equipamento_id` INT NOT NULL,
  `legislacao_id` INT NOT NULL,
  INDEX `fk_equipamento_legislacoes_legislacoes_idx` (`legislacao_id` ASC),
  INDEX `fk_equipamento_legislacoes_equipamentos_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_equipamento_legislacoes_legislacoes`
    FOREIGN KEY (`legislacao_id`)
    REFERENCES `simbi`.`legislacoes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipamento_legislacoes_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`areas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`areas` (
  `equipamento_id` INT NOT NULL,
  `interna` VARCHAR(60) NOT NULL,
  `auditorio` VARCHAR(60) NULL,
  `teatro` VARCHAR(60) NULL,
  `total_construida` VARCHAR(60) NOT NULL,
  `total_terreno` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`equipamento_id`),
  CONSTRAINT `fk_equipamento_areas_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`auditorios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`auditorios` (
  `equipamento_id` INT NOT NULL,
  `nome` VARCHAR(60) NOT NULL,
  `capacidade` SMALLINT(4) NOT NULL,
  INDEX `fk_auditorios_equipamentos1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_auditorios_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`teatros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`teatros` (
  `equipamento_id` INT NOT NULL,
  `nome` VARCHAR(60) NOT NULL,
  `capacidade` SMALLINT(4) NOT NULL,
  INDEX `fk_teatros_equipamentos1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_teatros_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`sala_multiusos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`sala_multiusos` (
  `equipamento_id` INT NOT NULL,
  `capacidade` SMALLINT(4) NOT NULL,
  INDEX `fk_sala_multiusos_equipamentos1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_sala_multiusos_equipamentos1`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`sala_estudo_grupos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`sala_estudo_grupos` (
  `equipamento_id` INT NOT NULL,
  `capacidade` SMALLINT(4) NOT NULL,
  INDEX `fk_sala_estudo_grupos_equipamentos1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_sala_estudo_grupos_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`sala_estudo_individuais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`sala_estudo_individuais` (
  `equipamento_id` INT NOT NULL,
  `quantidade` TINYINT(2) NOT NULL,
  INDEX `fk_sala_estudo_individuais_equipamentos1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_sala_estudo_individuais_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`sala_infantis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`sala_infantis` (
  `equipamento_id` INT NOT NULL,
  `capacidade` SMALLINT(4) NOT NULL,
  INDEX `fk_sala_infantis_equipamentos1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_sala_infantis_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`estacionamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`estacionamentos` (
  `equipamento_id` INT NOT NULL,
  `capacidade` SMALLINT(4) NOT NULL,
  INDEX `fk_estacionamentos_equipamentos1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_estacionamentos_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`classificacoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`classificacoes` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `classificacao` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`pracas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`pracas` (
  `equipamento_id` INT NOT NULL,
  `praca_classificacao_id` TINYINT(1) NOT NULL,
  INDEX `fk_praca_praca_classificacoes1_idx` (`praca_classificacao_id` ASC),
  INDEX `fk_praca_equipamentos1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_praca_praca_classificacoes`
    FOREIGN KEY (`praca_classificacao_id`)
    REFERENCES `simbi`.`classificacoes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_praca_equipamentos1`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`contrato_usos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`contrato_usos` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `contrato_uso` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`utilizacoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`utilizacoes` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `utilizacao` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`portes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`portes` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `porte` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`padroes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`padroes` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `padrao` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`acessibilidade_arquitetonicas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`acessibilidade_arquitetonicas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `acessibilidade_arquitetonica` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`elevadores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`elevadores` (
  `id` TINYINT(1) NOT NULL,
  `elevador` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`acessibilidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`acessibilidades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `acessibilidade_arquitetonica_id` INT NOT NULL,
  `banheiros_adaptados` TINYINT(1) NOT NULL,
  `rampas_acesso` TINYINT(1) NOT NULL,
  `elevador_id` TINYINT(1) NOT NULL,
  `piso_tatil` TINYINT(1) NOT NULL,
  `estacionamento_acessivel` TINYINT(1) NOT NULL,
  `quantidade_vagas` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `acessibilidades_acessibilidadesArquitetonicas_fk_idx` (`acessibilidade_arquitetonica_id` ASC),
  INDEX `fk_elevador_idx` (`elevador_id` ASC),
  CONSTRAINT `acessibilidades_acessibilidadesArquitetonicas_fk`
    FOREIGN KEY (`acessibilidade_arquitetonica_id`)
    REFERENCES `simbi`.`acessibilidade_arquitetonicas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_elevador`
    FOREIGN KEY (`elevador_id`)
    REFERENCES `simbi`.`elevadores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`detalhes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`detalhes` (
  `equipamento_id` INT NOT NULL,
  `contrato_uso_id` TINYINT(1) NOT NULL,
  `utilizacao_id` TINYINT(1) NOT NULL,
  `porte_id` TINYINT(1) NOT NULL,
  `padrao_id` TINYINT(1) NOT NULL,
  `pavimento` TINYINT(2) NOT NULL,
  `acessibilidade_id` INT NOT NULL,
  `validade_avcb` DATE NOT NULL,
  PRIMARY KEY (`equipamento_id`),
  INDEX `fk_equipamento_detalhes_contrato_usos1_idx` (`contrato_uso_id` ASC),
  INDEX `fk_equipamento_detalhes_equipamento_utilizacoes1_idx` (`utilizacao_id` ASC),
  INDEX `fk_equipamento_detalhes_equipamento_portes1_idx` (`porte_id` ASC),
  INDEX `fk_equipamento_detalhes_equipamento_padroes1_idx` (`padrao_id` ASC),
  INDEX `fk_equipamento_detalhes_acessibilidades1_idx` (`acessibilidade_id` ASC),
  CONSTRAINT `fk_detalhes_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalhes_contratoUsos`
    FOREIGN KEY (`contrato_uso_id`)
    REFERENCES `simbi`.`contrato_usos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalhes_utilizacoes`
    FOREIGN KEY (`utilizacao_id`)
    REFERENCES `simbi`.`utilizacoes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipamento_detalhes_equipamento_portes1`
    FOREIGN KEY (`porte_id`)
    REFERENCES `simbi`.`portes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipamento_detalhes_equipamento_padroes1`
    FOREIGN KEY (`padrao_id`)
    REFERENCES `simbi`.`padroes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipamento_detalhes_acessibilidades1`
    FOREIGN KEY (`acessibilidade_id`)
    REFERENCES `simbi`.`acessibilidades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`reformas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`reformas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `equipamento_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `inicio_reforma` DATE NOT NULL,
  `termino_reforma` DATE NULL DEFAULT NULL,
  `descricao` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_reformas_equipamentos1_idx` (`equipamento_id` ASC),
  INDEX `fk_reformas_equipamentos2_idx` (`user_id` ASC),
  CONSTRAINT `fk_reformas_equipamentos1`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reformas_equipamentos2`
    FOREIGN KEY (`user_id`)
    REFERENCES `simbi`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`contratacao_formas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`contratacao_formas` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `forma_contratacao` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`tipo_eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`tipo_eventos` (
  `id` TINYINT(2) NOT NULL,
  `tipo_evento` VARCHAR(45) NOT NULL,
  `publicado` TINYINT(1) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`eventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome_evento` VARCHAR(45) NOT NULL,
  `tipo_evento_id` TINYINT(2) NOT NULL,
  `contratacao_forma_id` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_eventos_contratacao_formas1_idx` (`contratacao_forma_id` ASC),
  INDEX `fk_eventos_tipo_eventos1_idx` (`tipo_evento_id` ASC),
  CONSTRAINT `fk_eventos_contratacao_formas`
    FOREIGN KEY (`contratacao_forma_id`)
    REFERENCES `simbi`.`contratacao_formas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_tipo_eventos`
    FOREIGN KEY (`tipo_evento_id`)
    REFERENCES `simbi`.`tipo_eventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`frequencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`frequencia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `evento_id` INT NOT NULL COMMENT 'importar o evento do IGSIS',
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `crianca` SMALLINT(4) NOT NULL DEFAULT 0,
  `jovem` SMALLINT(4) NOT NULL DEFAULT 0,
  `adulto` SMALLINT(4) NOT NULL DEFAULT 0,
  `idoso` SMALLINT(4) NOT NULL DEFAULT 0,
  `total` SMALLINT(5) NOT NULL DEFAULT 0,
  `observacao` VARCHAR(255) NULL DEFAULT NULL,
  `user_id` INT NOT NULL,
  `equipamento_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_frequencia_users_idx` (`user_id` ASC),
  INDEX `fk_frequencia_equipamento_idx` (`equipamento_id` ASC),
  INDEX `fk_frequencia_eventos1_idx` (`evento_id` ASC),
  CONSTRAINT `fk_frequencia_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `simbi`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequencia_equipamento`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequencia_eventos`
    FOREIGN KEY (`evento_id`)
    REFERENCES `simbi`.`eventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`evento_ocorrencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`evento_ocorrencias` (
  `evento_id` INT NOT NULL,
  `equipamento_id` INT NOT NULL,
  `dia_semana` VARCHAR(45) NOT NULL,
  `data` DATE NOT NULL,
  `horario` TIME NOT NULL,
  INDEX `fk_ocorrencia_eventos_eventos1_idx` (`evento_id` ASC),
  INDEX `fk_evento_ocorrencias_equipamentos1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_ocorrencia_eventos_eventos`
    FOREIGN KEY (`evento_id`)
    REFERENCES `simbi`.`eventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_ocorrencias_equipamentos1`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`equipamentos_capacidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`equipamentos_capacidades` (
  `equipamento_id` TINYINT(2) NOT NULL,
  `capacidade` SMALLINT(4) NULL,
  PRIMARY KEY (`equipamento_id`),
  CONSTRAINT `fk_equipamentosCapacidades_equipamentos`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`tipo_servico_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`dia_semanas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`dia_semanas` (
  `id` TINYINT(1) NOT NULL,
  `dia` VARCHAR(7) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`frequencias_publicos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`frequencias_publicos` (
  `id` TINYINT(2) NOT NULL AUTO_INCREMENT,
  `dia_semana_id` TINYINT(1) NOT NULL,
  `crianca` SMALLINT(4) NOT NULL DEFAULT 0,
  `jovem` SMALLINT(4) NOT NULL DEFAULT 0,
  `adulto` SMALLINT(4) NOT NULL DEFAULT 0,
  `idoso` SMALLINT(4) NOT NULL DEFAULT 0,
  `total` SMALLINT(5) NOT NULL DEFAULT 0,
  `user_id` INT NOT NULL,
  `equipamento_id` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_frequenciasPublico_equipamento_idx` (`equipamento_id` ASC),
  INDEX `fk_frequenciasPublico_diaSemana_idx` (`dia_semana_id` ASC),
  INDEX `fk_frequenciasPublico_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_frequenciasPublico_equipamento`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`tipo_servico_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequenciasPublico_diaSemana`
    FOREIGN KEY (`dia_semana_id`)
    REFERENCES `simbi`.`dia_semanas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequenciasPublico_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `simbi`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`frequencias_portarias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`frequencias_portarias` (
  `id` TINYINT(2) NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `equipamento_id` INT NOT NULL,
  `nome` VARCHAR(60) NOT NULL,
  `data` DATE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_frequenciaPortaria_user_idx` (`user_id` ASC),
  INDEX `fk_frequenciaPortaria_equipamento_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_frequenciaPortaria_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `simbi`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequenciaPortaria_equipamento`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `simbi`.`equipamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`sexos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`sexos` (
  `id` TINYINT(2) NOT NULL,
  `sexo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`etnias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`etnias` (
  `id` TINYINT(2) NOT NULL,
  `etnia` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`deficiencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`deficiencias` (
  `id` TINYINT(2) NOT NULL,
  `deficiencia` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simbi`.`complemento_portarias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simbi`.`complemento_portarias` (
  `id` TINYINT(2) NOT NULL,
  `portaria_id` TINYINT(2) NOT NULL,
  `idade` SMALLINT(3) NOT NULL,
  `sexo_id` TINYINT(2) NOT NULL,
  `etnia_id` TINYINT(2) NOT NULL,
  `escolaridade_id` TINYINT(2) NOT NULL,
  `deficiencia_id` TINYINT(2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_complementoPortarias_frequenciasPortarias_idx` (`portaria_id` ASC),
  INDEX `fk_complementoPortarias_escolaridades_idx` (`escolaridade_id` ASC),
  INDEX `fk_complementoPortarias_sexo_idx` (`sexo_id` ASC),
  INDEX `fk_complementoPortarias_etnia_idx` (`etnia_id` ASC),
  INDEX `fk_complementoPortarias_deficiena_idx` (`deficiencia_id` ASC),
  CONSTRAINT `fk_complementoPortarias_frequenciasPortarias`
    FOREIGN KEY (`portaria_id`)
    REFERENCES `simbi`.`frequencias_portarias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_complementoPortarias_escolaridades`
    FOREIGN KEY (`escolaridade_id`)
    REFERENCES `simbi`.`escolaridades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_complementoPortarias_sexo`
    FOREIGN KEY (`sexo_id`)
    REFERENCES `simbi`.`sexos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_complementoPortarias_etnia`
    FOREIGN KEY (`etnia_id`)
    REFERENCES `simbi`.`etnias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_complementoPortarias_deficiena`
    FOREIGN KEY (`deficiencia_id`)
    REFERENCES `simbi`.`deficiencias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- begin attached script 'script'
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

DELETE FROM `elevadores`;
/*!40000 ALTER TABLE `elevadores` DISABLE KEYS */;
INSERT INTO `simbi`.`elevadores` (`id`, `elevador`) VALUES 
(1, 'Não'), 
(2, 'Sim'), 
(3, 'Sim, porém em manutenção');
/*!40000 ALTER TABLE `elevadores` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamentos: ~0 rows (aproximadamente)
DELETE FROM `escolaridades`;
/*!40000 ALTER TABLE `escolaridades` DISABLE KEYS */;
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
  (1, 'Grande'),
  (2, 'Médio'),
  (3, 'Grande');
/*!40000 ALTER TABLE `portes` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.equipamentos_users: ~0 rows (aproximadamente)
DELETE FROM `equipamento_user`;
/*!40000 ALTER TABLE `equipamento_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamento_user` ENABLE KEYS */;

-- Copiando dados para a tabela simbi.utilizacoes:
DELETE FROM `utilizacoes`;
/*!40000 ALTER TABLE `utilizacoes` DISABLE KEYS */;
INSERT INTO `utilizacoes` (`id`, `utilizacao`) VALUES
  (1, 'Parcial'),
  (2, 'Total');
/*!40000 ALTER TABLE `utilizacoes` ENABLE KEYS */;

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
	(1, 'CSMB'),
    (2, 'Funcionário'),
    (3, 'SMC'),
    (4, 'Voluntario');
/*!40000 ALTER TABLE `contratacao_formas` ENABLE KEYS */;

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

-- end attached script 'script'
