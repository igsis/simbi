--
-- Database: `dbsimbi`
--

CREATE DATABASE dbsimbi;
USE `dbsimbi`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_alexandria`
--

CREATE TABLE `acervo_alexandria` (
  `idAcervoAlexandria` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `quantidadeMaterial` int(5) DEFAULT NULL,
  `idMaterial` int(10) UNSIGNED NOT NULL,
  `idTipoMaterial` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='49 - Acervo Importado do Alexandria';

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_forma_documento`
--

CREATE TABLE `acervo_forma_documento` (
  `idAcervoFormaDocumento` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='51 - Forma do Documento do Acervo';

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_forma_movimentacao`
--

CREATE TABLE `acervo_forma_movimentacao` (
  `idAcervoFormaMovimentacao` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idFormaDocumentoAcervo` int(10) UNSIGNED NOT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `qtdConsultada` int(5) DEFAULT NULL,
  `qtdEmprestada` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='12 - Movimentacao Forma do Acervo';

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_movimentacao`
--

CREATE TABLE `acervo_movimentacao` (
  `idAcervoMovimentacao` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idMaterial` int(10) UNSIGNED NOT NULL,
  `idTipoMaterial` int(10) UNSIGNED NOT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `qtdConsultada` int(5) DEFAULT NULL,
  `qtdConsultadaTematico` int(5) DEFAULT NULL,
  `qtdEmprestada` int(5) DEFAULT NULL,
  `qtdEmprestadaTematico` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='11 - Movimentacao Acervo';

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_quantidade`
--

CREATE TABLE `acervo_quantidade` (
  `idAcervoQuantidade` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idMaterial` int(10) UNSIGNED NOT NULL,
  `idTipoMaterial` int(10) UNSIGNED NOT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `idAcervoAlexandria` int(10) UNSIGNED NOT NULL,
  `qtdAcervoTematico` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='10 - Quantidade Acervo';

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessibilidade_arquitetonica`
--

CREATE TABLE `acessibilidade_arquitetonica` (
  `idAcessibilidadeArquitetonica` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Total, Parcial ou Nao Acessivel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.6 - Acessibilidade Arquitetonica';

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimento_recepcao`
--

CREATE TABLE `atendimento_recepcao` (
  `idAtendimentoRecepcao` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `data` date DEFAULT NULL,
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `idEtnia` int(10) UNSIGNED NOT NULL,
  `idSexo` int(10) UNSIGNED NOT NULL,
  `idEscolaridade` int(10) UNSIGNED NOT NULL,
  `idDeficiencia` int(10) UNSIGNED NOT NULL,
  `idFaixaEtaria` int(10) UNSIGNED NOT NULL,
  `quantidadeUsuarios` int(3) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='08 - Atendimento Recepcao';

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `idCargo` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'AA, AGPP/ATA, AA Vigia, Bibliotecario, Outro de Nivel Superior'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='25 - Cargo';

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_etaria`
--

CREATE TABLE `categoria_etaria` (
  `idCategoriaEtaria` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='38 - Categoria Etaria';

-- --------------------------------------------------------

--
-- Estrutura da tabela `classificacao_area_externa`
--

CREATE TABLE `classificacao_area_externa` (
  `idClassificacaoAreaExterna` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Pequena, Media ou Grande'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.1 - Classificacao Area Externa';

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato_uso`
--

CREATE TABLE `contrato_uso` (
  `idContratoUso` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Proprio, Alugado ou Concessao de Uso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.2 - Contrato de Uso';

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_acesso`
--

CREATE TABLE `controle_acesso` (
  `idControleAcesso` int(10) UNSIGNED NOT NULL,
  `rfServidor` char(9) CHARACTER SET latin1 NOT NULL,
  `login` varchar(50) CHARACTER SET latin1 NOT NULL,
  `senha` varchar(50) CHARACTER SET latin1 NOT NULL,
  `idNivelAcesso` int(10) UNSIGNED NOT NULL,
  `idFuncionalidadesAcesso` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='52 - Controle de Acesso';

-- --------------------------------------------------------

--
-- Estrutura da tabela `custo_evento_igsis`
--

CREATE TABLE `custo_evento_igsis` (
  `idCustoEventoIgsis` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idProgramacaoCultural` int(10) UNSIGNED NOT NULL,
  `custoEvento` decimal(10,2) DEFAULT NULL,
  `idFormaContratacao` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='50 - Custo do Evento Importado do Igsis';

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_edificacao`
--

CREATE TABLE `dados_edificacao` (
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `areaInterna` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `areaAuditorio` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `areaTeatro` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `areaTotalConstruida` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `areaTotalTerreno` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `auditorio` tinyint(1) NOT NULL DEFAULT '0',
  `auditorioNome` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `auditorioCapacidade` int(4) DEFAULT NULL,
  `teatro` tinyint(1) NOT NULL DEFAULT '0',
  `teatroNome` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `teatroCapacidade` int(4) DEFAULT NULL,
  `salaMultiuso` tinyint(1) NOT NULL DEFAULT '0',
  `salaMultiusoCapacidade` int(4) DEFAULT NULL,
  `capacidadeOutros` int(4) DEFAULT NULL,
  `salaEstudoGrupo` tinyint(1) NOT NULL DEFAULT '0',
  `salaEstudoGrupoCapacidade` int(4) DEFAULT NULL,
  `salaEstudoIndividual` tinyint(1) NOT NULL DEFAULT '0',
  `salaEstudoIndividualSalas` int(4) DEFAULT NULL,
  `salaInfantil` tinyint(1) NOT NULL DEFAULT '0',
  `salaInfantilCapacidade` int(4) DEFAULT NULL,
  `estacionamento` tinyint(1) NOT NULL DEFAULT '0',
  `estacionamentoCapacidade` int(4) DEFAULT NULL,
  `situadaPraca` tinyint(1) DEFAULT NULL,
  `idClassificacaoAreaExterna` int(10) UNSIGNED NOT NULL,
  `idContratoUso` int(10) UNSIGNED NOT NULL,
  `idUtilizacao` int(10) UNSIGNED NOT NULL,
  `idPorte` int(10) UNSIGNED NOT NULL,
  `idPadrao` int(10) UNSIGNED NOT NULL,
  `pavimentos` int(2) DEFAULT NULL,
  `idAcessibilidadeArquitetonica` int(10) UNSIGNED NOT NULL,
  `banheirosAdaptados` tinyint(1) DEFAULT '0',
  `rampasAcesso` tinyint(1) DEFAULT '0',
  `elevador` tinyint(1) DEFAULT '0',
  `pisoTatil` tinyint(1) DEFAULT '0',
  `estacionamentoAcessivel` tinyint(1) NOT NULL DEFAULT '0',
  `estacionamentoAcessivelCapacidade` int(4) DEFAULT NULL,
  `segurancaValidade` date DEFAULT NULL,
  `dataInicioReforma` date DEFAULT NULL,
  `dataTerminoReforma` date DEFAULT NULL,
  `descricaoServicos` longtext CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05 - Dados da Edificacao\n1FN';

-- --------------------------------------------------------

--
-- Estrutura da tabela `deficiencia`
--

CREATE TABLE `deficiencia` (
  `idDeficiencia` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='40 - Deficiencia';

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesa_categoria`
--

CREATE TABLE `despesa_categoria` (
  `idDespesaCategoria` int(10) UNSIGNED NOT NULL,
  `descricao` longtext CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='46 - Categoria da Despesa';

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesa_financeira`
--

CREATE TABLE `despesa_financeira` (
  `idDespesaFinanceira` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idDespesaTipo` int(10) UNSIGNED NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='20 - Despesa Financeira';

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesa_tipo`
--

CREATE TABLE `despesa_tipo` (
  `idDespesaTipo` int(10) UNSIGNED NOT NULL,
  `descricao` longtext CHARACTER SET latin1 NOT NULL,
  `idDespesaCategoria` int(10) UNSIGNED NOT NULL,
  `publicado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='47 - Tipo de Despesa';

-- --------------------------------------------------------

--
-- Estrutura da tabela `distrito`
--

CREATE TABLE `distrito` (
  `idDistrito` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='31 - Distrito';

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento_tipo`
--

CREATE TABLE `documento_tipo` (
  `idTipoDocumento` int(10) UNSIGNED NOT NULL,
  `documento` varchar(6) CHARACTER SET latin1 NOT NULL,
  `descricao` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='45 - Tipo do Documento';

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `idEndereco` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(15) CHARACTER SET latin1 NOT NULL,
  `titulo` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `preposicao` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL,
  `numero` int(6) NOT NULL,
  `complemento` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `cep` char(9) CHARACTER SET latin1 NOT NULL,
  `bairro` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='01.3 - Endereco';

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL,
  `idTipoServico` int(10) UNSIGNED NOT NULL,
  `idSigla` int(10) UNSIGNED NOT NULL,
  `idSecretaria` int(10) UNSIGNED NOT NULL,
  `idSubordinacaoAdministrativa` int(10) UNSIGNED NOT NULL,
  `tematica` tinyint(1) NOT NULL,
  `nomeTematica` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `idEndereco` int(10) UNSIGNED NOT NULL,
  `telefone` varchar(15) CHARACTER SET latin1 NOT NULL,
  `idSubPrefeitura` int(10) UNSIGNED NOT NULL,
  `idDistrito` int(10) UNSIGNED NOT NULL,
  `idMacrorregiao` int(10) UNSIGNED NOT NULL,
  `idRegiao` int(10) UNSIGNED NOT NULL,
  `idRegional` int(10) UNSIGNED NOT NULL,
  `idFuncionamento` int(10) UNSIGNED NOT NULL,
  `telecentro` tinyint(1) NOT NULL DEFAULT '0',
  `nucleoBraille` tinyint(1) NOT NULL DEFAULT '0',
  `acervoEspecializado` tinyint(1) NOT NULL DEFAULT '0',
  `idStatusEquipamento` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='01 - Cadastro Equipamento\n1FN';

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento_sigla`
--

CREATE TABLE `equipamento_sigla` (
  `idSigla` int(10) UNSIGNED NOT NULL,
  `sigla` varchar(6) CHARACTER SET latin1 NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `roteiro` longtext CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='43 - Sigla do Equipamento';

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolaridade`
--

CREATE TABLE `escolaridade` (
  `idEscolaridade` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='35 - Escolaridade';

-- --------------------------------------------------------

--
-- Estrutura da tabela `etnia`
--

CREATE TABLE `etnia` (
  `idEtnia` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='39 - Cor/Raca';

-- --------------------------------------------------------

--
-- Estrutura da tabela `faixa_etaria`
--

CREATE TABLE `faixa_etaria` (
  `idFaixaEtaria` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `inicioFaixaEtaria` int(3) NOT NULL,
  `fimFaixaEtaria` int(3) NOT NULL,
  `dataValidade` date DEFAULT NULL,
  `idCategoriaEtaria` int(10) UNSIGNED NOT NULL,
  `publicado` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='37 - Faixa Etaria';

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_contratacao`
--

CREATE TABLE `forma_contratacao` (
  `idFormaContratacao` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='24 - Forma de Contratacao';

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--

CREATE TABLE `funcao` (
  `idFuncao` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='26 - Funcao';

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionalidades_acesso`
--

CREATE TABLE `funcionalidades_acesso` (
  `idFuncionalidadesAcesso` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='52.2 - Funcionalidades de Acesso';

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionamento`
--

CREATE TABLE `funcionamento` (
  `idFuncionamento` int(10) UNSIGNED NOT NULL,
  `segunda` tinyint(1) NOT NULL DEFAULT '0',
  `terca` tinyint(1) NOT NULL DEFAULT '0',
  `quarta` tinyint(1) NOT NULL DEFAULT '0',
  `quinta` tinyint(1) NOT NULL DEFAULT '0',
  `sexta` tinyint(1) NOT NULL DEFAULT '0',
  `sabado` tinyint(1) NOT NULL DEFAULT '0',
  `domingo` tinyint(1) NOT NULL DEFAULT '0',
  `horaInicial` time DEFAULT NULL,
  `horaFinal` time DEFAULT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='01.1 - Funcionamento';

-- --------------------------------------------------------

--
-- Estrutura da tabela `legislacao`
--

CREATE TABLE `legislacao` (
  `idLegislacao` int(10) UNSIGNED NOT NULL,
  `idLegislacaoTipo` int(10) UNSIGNED NOT NULL,
  `numero` int(5) NOT NULL,
  `ano` int(4) NOT NULL,
  `ementa` longtext CHARACTER SET latin1,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='21 - Legislacao';

-- --------------------------------------------------------

--
-- Estrutura da tabela `legislacao_equipamento`
--

CREATE TABLE `legislacao_equipamento` (
  `idLegislacaoEquipamento` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `idLegislacao` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='04 - Legislacao do Equipamento\n1FN';

-- --------------------------------------------------------

--
-- Estrutura da tabela `legislacao_tipo`
--

CREATE TABLE `legislacao_tipo` (
  `idLegislacaoTipo` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Lei, Decreto ou Portaria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='21.1 - Tipo Legislacao';

-- --------------------------------------------------------

--
-- Estrutura da tabela `macrorregiao`
--

CREATE TABLE `macrorregiao` (
  `idMacrorregiao` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Centro - Noroeste - Norte - Leste 1 - Leste 2 - Leste 3 - Sul 1 - Sul 2, Sudoeste, Sudeste, Leste 4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='30 - Macrorregiao';

-- --------------------------------------------------------

--
-- Estrutura da tabela `material`
--

CREATE TABLE `material` (
  `idMaterial` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='41 - Material';

-- --------------------------------------------------------

--
-- Estrutura da tabela `material_tipo`
--

CREATE TABLE `material_tipo` (
  `idTipoMaterial` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='42 - Tipo de Material';

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula_importada_alexandria`
--

CREATE TABLE `matricula_importada_alexandria` (
  `idMatriculaImportadaAlexandria` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `data` date DEFAULT NULL,
  `qtdMatriculasNovas` int(5) DEFAULT NULL,
  `qtdMatriculasRenovadas` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='48 - Matricula Importada do Alexandria';

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_acesso`
--

CREATE TABLE `nivel_acesso` (
  `idNivelAcesso` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='52.1 - Nivel de Acesso';

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencia_equipamento`
--

CREATE TABLE `ocorrencia_equipamento` (
  `idOcorrenciaEquipamento` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `dataReferencia` date NOT NULL,
  `ocorrencia` longtext CHARACTER SET latin1 NOT NULL,
  `observacao` longtext CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='03 - Ocorrencia Equipamento\n1FN';

-- --------------------------------------------------------

--
-- Estrutura da tabela `padrao`
--

CREATE TABLE `padrao` (
  `idPadrao` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Janio Novo ou Janio Antigo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.5 - Padrao';

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `porte`
--

CREATE TABLE `porte` (
  `idPorte` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Grande, Medio ou Pequeno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.4 - Porte';

-- --------------------------------------------------------

--
-- Estrutura da tabela `programacao_cultural`
--

CREATE TABLE `programacao_cultural` (
  `idProgramacaoCultural` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `idTipoEvento` int(10) UNSIGNED NOT NULL,
  `idFormaContratacao` int(10) UNSIGNED NOT NULL,
  `rfFuncionario` char(9) CHARACTER SET latin1 NOT NULL,
  `nomeAcao` longtext CHARACTER SET latin1,
  `custo` decimal(10,2) DEFAULT NULL,
  `eventoInterno` tinyint(1) DEFAULT '0',
  `idProjetoEspecial` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='13 - Cadastro Programacao Cultural';

-- --------------------------------------------------------

--
-- Estrutura da tabela `programacao_cultural_data`
--

CREATE TABLE `programacao_cultural_data` (
  `idProgramacaoCulturalData` int(10) UNSIGNED NOT NULL,
  `idProgramacaoCultural` int(10) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='14 - Data da Programacao Cultural';

-- --------------------------------------------------------

--
-- Estrutura da tabela `programacao_cultural_frequencia`
--

CREATE TABLE `programacao_cultural_frequencia` (
  `idProgramacaoCulturalFrequencia` int(10) UNSIGNED NOT NULL,
  `idProgramacaoCulturalData` int(10) UNSIGNED NOT NULL,
  `idProgramacaoCultural` int(10) UNSIGNED NOT NULL,
  `idCategoriaEtaria` int(10) UNSIGNED NOT NULL,
  `frequenciaQuantidade` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='15 - Frequencia da Programacao Cultural';

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_especial`
--

CREATE TABLE `projeto_especial` (
  `idProjetoEspecial` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='22 - Projeto Especial';

-- --------------------------------------------------------

--
-- Estrutura da tabela `regiao`
--

CREATE TABLE `regiao` (
  `idRegiao` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Norte, Sul, Leste, Centro, Oeste'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='28 - Regiao';

-- --------------------------------------------------------

--
-- Estrutura da tabela `regional`
--

CREATE TABLE `regional` (
  `idRegional` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Leste-1, Norte, Sul, Leste-2, Oeste, Centro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='29 - Regional';

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel_equipamento`
--

CREATE TABLE `responsavel_equipamento` (
  `idResponsavelEquipamento` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `rfFuncionario` char(9) CHARACTER SET latin1 NOT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `idTipoResponsabilidade` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='02 - Responsavel pelo Equipamento\n1FN';

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretaria`
--

CREATE TABLE `secretaria` (
  `idSecretaria` int(10) UNSIGNED NOT NULL,
  `sigla` varchar(6) CHARACTER SET latin1 NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='33 - Secretaria';

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_extensao`
--

CREATE TABLE `servico_extensao` (
  `idServicoExtensao` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idCategoriaEtaria` int(10) UNSIGNED NOT NULL,
  `quantidadeAtendimento` int(3) DEFAULT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `dataAtual` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='09 - Servico Extensao';

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_tipo`
--

CREATE TABLE `servico_tipo` (
  `idTipoServico` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'CSMB - Bosque da Leitura, Ponto de Leitura, Onibus Biblioteca, Caixa - Estante, Feira de Troca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='44 - Tipo do Servico';

-- --------------------------------------------------------

--
-- Estrutura da tabela `servidor`
--

CREATE TABLE `servidor` (
  `rfServidor` char(9) CHARACTER SET latin1 NOT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL,
  `idCargo` int(10) UNSIGNED NOT NULL,
  `idFuncao` int(10) UNSIGNED NOT NULL,
  `idEscolaridade` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `aposentadoriaMes` int(2) NOT NULL,
  `aposentadoriaAno` int(4) NOT NULL,
  `idSecretaria` int(10) UNSIGNED NOT NULL,
  `idSubordinacaoAdministrativa` int(10) UNSIGNED NOT NULL,
  `publicado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='16 - Cadastro de Servidor';

-- --------------------------------------------------------

--
-- Estrutura da tabela `servidor_convocado`
--

CREATE TABLE `servidor_convocado` (
  `idServidorConvocado` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `rfServidor` char(9) CHARACTER SET latin1 NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='18 - Servidor Convocado';

-- --------------------------------------------------------

--
-- Estrutura da tabela `servidor_lotado_equipamento`
--

CREATE TABLE `servidor_lotado_equipamento` (
  `idServidorLotadoEquipamento` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `rfServidor` char(9) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='17 - Servidor Lotado no Equipamento';

-- --------------------------------------------------------

--
-- Estrutura da tabela `sexo`
--

CREATE TABLE `sexo` (
  `idSexo` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(1) CHARACTER SET latin1 NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `publicado` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='36 - Sexo';

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_equipamento`
--

CREATE TABLE `status_equipamento` (
  `idStatusEquipamento` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='01.2 - Status do Equipamento';

-- --------------------------------------------------------

--
-- Estrutura da tabela `subordinacao_administrativa`
--

CREATE TABLE `subordinacao_administrativa` (
  `idSubordinacaoAdministrativa` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='34 - Subordinacao Administrativa';

-- --------------------------------------------------------

--
-- Estrutura da tabela `subprefeitura`
--

CREATE TABLE `subprefeitura` (
  `idSubPrefeitura` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='32 - Subprefeitura';

-- --------------------------------------------------------

--
-- Estrutura da tabela `terceirizada_quantidade`
--

CREATE TABLE `terceirizada_quantidade` (
  `idTerceirizadaQuantidade` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `idTipoTerceirizada` int(10) UNSIGNED NOT NULL,
  `quantidade` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='19 - Quantidade Terceirizada';

-- --------------------------------------------------------

--
-- Estrutura da tabela `terceirizada_tipo`
--

CREATE TABLE `terceirizada_tipo` (
  `idTerceirizadaTipo` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='27 - Tipo de Terceirizada';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_evento`
--

CREATE TABLE `tipo_evento` (
  `idTipoEvento` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='23 - Tipo do Evento da Programacao Cultural';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_responsabilidade`
--

CREATE TABLE `tipo_responsabilidade` (
  `idTipoResponsabilidade` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='02.1 Tipo de Responsabilidade';

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `matriculaAlexandria` int(11) DEFAULT NULL,
  `idTipoDocumento` int(10) UNSIGNED NOT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL,
  `nomeSocial` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `idSexo` int(10) UNSIGNED NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `idEscolaridade` int(10) UNSIGNED NOT NULL,
  `idEtnia` int(10) UNSIGNED NOT NULL,
  `idDeficiencia` int(10) UNSIGNED NOT NULL,
  `idFaixaEtaria` int(10) UNSIGNED NOT NULL,
  `dataAtual` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='06 - Cadastro Usuario\n1FN';

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_servico`
--

CREATE TABLE `usuario_servico` (
  `idUsuarioServico` int(10) UNSIGNED NOT NULL,
  `idEquipamento` int(10) UNSIGNED NOT NULL,
  `data` date DEFAULT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `diasAbertos` int(2) DEFAULT NULL,
  `idMatriculaImportadaAlexandria` int(10) UNSIGNED NOT NULL,
  `servicoEspecial` tinyint(1) DEFAULT '0',
  `publicoTelecentros` int(5) DEFAULT NULL,
  `publicoSecaoTematica` int(5) DEFAULT NULL,
  `publicoSecaoBraile` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='07 - Servico Usuario';

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizacao`
--

CREATE TABLE `utilizacao` (
  `idUtilizacao` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Total ou Parcial'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.3 - Utilizacao';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acervo_alexandria`
--
ALTER TABLE `acervo_alexandria`
  ADD PRIMARY KEY (`idAcervoAlexandria`),
  ADD KEY `acervoalexandria_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `acervoalexandria_material_fk_idx` (`idMaterial`),
  ADD KEY `acervoalexandria_materialtipo_fk_idx` (`idTipoMaterial`);

--
-- Indexes for table `acervo_forma_documento`
--
ALTER TABLE `acervo_forma_documento`
  ADD PRIMARY KEY (`idAcervoFormaDocumento`);

--
-- Indexes for table `acervo_forma_movimentacao`
--
ALTER TABLE `acervo_forma_movimentacao`
  ADD PRIMARY KEY (`idAcervoFormaMovimentacao`),
  ADD KEY `acervoformamovimentacao_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `acervoformamovimentacao_acervoformadocumento_fk_idx` (`idFormaDocumentoAcervo`),
  ADD KEY `acervoformamovimentacao_servidor_fk_idx` (`rfOperador`);

--
-- Indexes for table `acervo_movimentacao`
--
ALTER TABLE `acervo_movimentacao`
  ADD PRIMARY KEY (`idAcervoMovimentacao`),
  ADD KEY `acervomovimentacao_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `acervomovimentacao_material_fk_idx` (`idMaterial`),
  ADD KEY `acervomovimentacao_materialtipo_fk_idx` (`idTipoMaterial`),
  ADD KEY `acervomovimentacao_servidor_idx` (`rfOperador`);

--
-- Indexes for table `acervo_quantidade`
--
ALTER TABLE `acervo_quantidade`
  ADD PRIMARY KEY (`idAcervoQuantidade`),
  ADD KEY `acervoquantitade_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `acervoquantidade_material_fk_idx` (`idMaterial`),
  ADD KEY `acervoquantidade_materialtipo_fk_idx` (`idTipoMaterial`),
  ADD KEY `acervoquantidade_acervoalexandria_fk_idx` (`idAcervoAlexandria`),
  ADD KEY `acervoquantidade_servidor_idx` (`rfOperador`);

--
-- Indexes for table `acessibilidade_arquitetonica`
--
ALTER TABLE `acessibilidade_arquitetonica`
  ADD PRIMARY KEY (`idAcessibilidadeArquitetonica`);

--
-- Indexes for table `atendimento_recepcao`
--
ALTER TABLE `atendimento_recepcao`
  ADD PRIMARY KEY (`idAtendimentoRecepcao`),
  ADD KEY `atendimentorecepcao_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `atendimentorecepcao_usuario_fk_idx` (`idUsuario`),
  ADD KEY `atendimentorecepcao_etnia_fk_idx` (`idEtnia`),
  ADD KEY `atendimentorecepcao_sexo_fk_idx` (`idSexo`),
  ADD KEY `atendimentorecepcao_escolaridade_fk_idx` (`idEscolaridade`),
  ADD KEY `atendimentorecepcao_deficiencia_fk_idx` (`idDeficiencia`),
  ADD KEY `atendimentorecepcao_faixaetaria_fk_idx` (`idFaixaEtaria`),
  ADD KEY `atendimentorecepcao_servidor_fk_idx` (`rfOperador`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idCargo`);

--
-- Indexes for table `categoria_etaria`
--
ALTER TABLE `categoria_etaria`
  ADD PRIMARY KEY (`idCategoriaEtaria`);

--
-- Indexes for table `classificacao_area_externa`
--
ALTER TABLE `classificacao_area_externa`
  ADD PRIMARY KEY (`idClassificacaoAreaExterna`);

--
-- Indexes for table `contrato_uso`
--
ALTER TABLE `contrato_uso`
  ADD PRIMARY KEY (`idContratoUso`);

--
-- Indexes for table `controle_acesso`
--
ALTER TABLE `controle_acesso`
  ADD PRIMARY KEY (`idControleAcesso`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD KEY `controleacesso_servidor_fk_idx` (`rfServidor`),
  ADD KEY `controleacesso_nivelacesso_idx` (`idNivelAcesso`),
  ADD KEY `controleacesso_funcionalidadesacesso_fk_idx` (`idFuncionalidadesAcesso`);

--
-- Indexes for table `custo_evento_igsis`
--
ALTER TABLE `custo_evento_igsis`
  ADD PRIMARY KEY (`idCustoEventoIgsis`),
  ADD KEY `custoeventoigsis_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `custoeventoigsis_programacaocultural_fk_idx` (`idProgramacaoCultural`),
  ADD KEY `custoeventoigsis_formacontratacao_fk_idx` (`idFormaContratacao`);

--
-- Indexes for table `dados_edificacao`
--
ALTER TABLE `dados_edificacao`
  ADD PRIMARY KEY (`idEquipamento`),
  ADD KEY `dadosedificacao_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `dadosedificacao_classificacaoareaexterna_fk_idx` (`idClassificacaoAreaExterna`),
  ADD KEY `dadosedificacao_contratouso_fk_idx` (`idContratoUso`),
  ADD KEY `dadosedificacao_utilizacao_fk_idx` (`idUtilizacao`),
  ADD KEY `dadosedificacao_porte_fk_idx` (`idPorte`),
  ADD KEY `dadosedificacao_padrao_fk_idx` (`idPadrao`),
  ADD KEY `dadosedificacao_acessibilidadearquitetonica_fk_idx` (`idAcessibilidadeArquitetonica`);

--
-- Indexes for table `deficiencia`
--
ALTER TABLE `deficiencia`
  ADD PRIMARY KEY (`idDeficiencia`);

--
-- Indexes for table `despesa_categoria`
--
ALTER TABLE `despesa_categoria`
  ADD PRIMARY KEY (`idDespesaCategoria`);

--
-- Indexes for table `despesa_financeira`
--
ALTER TABLE `despesa_financeira`
  ADD PRIMARY KEY (`idDespesaFinanceira`),
  ADD KEY `despesafinanceira_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `despesafinanceira_despesatipo_fk_idx` (`idDespesaTipo`),
  ADD KEY `despesafinanceira_servidor_fk_idx` (`rfOperador`);

--
-- Indexes for table `despesa_tipo`
--
ALTER TABLE `despesa_tipo`
  ADD PRIMARY KEY (`idDespesaTipo`),
  ADD KEY `despesatipo_despesacategoria_fk_idx` (`idDespesaCategoria`);

--
-- Indexes for table `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`idDistrito`);

--
-- Indexes for table `documento_tipo`
--
ALTER TABLE `documento_tipo`
  ADD PRIMARY KEY (`idTipoDocumento`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idEndereco`);

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`idEquipamento`),
  ADD KEY `equipamento_servicotipo_fk_idx` (`idTipoServico`),
  ADD KEY `equipamento_equipamentosigla_fk_idx` (`idSigla`),
  ADD KEY `equipamento_secretaria_fk_idx` (`idSecretaria`),
  ADD KEY `equipamento_subordinacaoadministrativa_fk_idx` (`idSubordinacaoAdministrativa`),
  ADD KEY `equipamento_subprefeitura_fk_idx` (`idSubPrefeitura`),
  ADD KEY `equipamento_distrito_fk_idx` (`idDistrito`),
  ADD KEY `equipamento_macroregiao_fk_idx` (`idMacrorregiao`),
  ADD KEY `equipamento_regiao_idx` (`idRegiao`),
  ADD KEY `equipamento_regional_idx` (`idRegional`),
  ADD KEY `equipamento_funcionamento_idx` (`idFuncionamento`),
  ADD KEY `equipamento_status_fk_idx` (`idStatusEquipamento`),
  ADD KEY `equipamento_endereco_fk_idx` (`idEndereco`);

--
-- Indexes for table `equipamento_sigla`
--
ALTER TABLE `equipamento_sigla`
  ADD PRIMARY KEY (`idSigla`);

--
-- Indexes for table `escolaridade`
--
ALTER TABLE `escolaridade`
  ADD PRIMARY KEY (`idEscolaridade`);

--
-- Indexes for table `etnia`
--
ALTER TABLE `etnia`
  ADD PRIMARY KEY (`idEtnia`);

--
-- Indexes for table `faixa_etaria`
--
ALTER TABLE `faixa_etaria`
  ADD PRIMARY KEY (`idFaixaEtaria`),
  ADD KEY `faixaetaria_categoriaetaria_fk_idx` (`idCategoriaEtaria`);

--
-- Indexes for table `forma_contratacao`
--
ALTER TABLE `forma_contratacao`
  ADD PRIMARY KEY (`idFormaContratacao`);

--
-- Indexes for table `funcao`
--
ALTER TABLE `funcao`
  ADD PRIMARY KEY (`idFuncao`);

--
-- Indexes for table `funcionalidades_acesso`
--
ALTER TABLE `funcionalidades_acesso`
  ADD PRIMARY KEY (`idFuncionalidadesAcesso`);

--
-- Indexes for table `funcionamento`
--
ALTER TABLE `funcionamento`
  ADD PRIMARY KEY (`idFuncionamento`);

--
-- Indexes for table `legislacao`
--
ALTER TABLE `legislacao`
  ADD PRIMARY KEY (`idLegislacao`),
  ADD KEY `legislacao_legislacaotipo_fk_idx` (`idLegislacaoTipo`);

--
-- Indexes for table `legislacao_equipamento`
--
ALTER TABLE `legislacao_equipamento`
  ADD PRIMARY KEY (`idLegislacaoEquipamento`),
  ADD KEY `legislacaoequipamento_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `legislacaoequipamento_legislacao_fk_idx` (`idLegislacao`);

--
-- Indexes for table `legislacao_tipo`
--
ALTER TABLE `legislacao_tipo`
  ADD PRIMARY KEY (`idLegislacaoTipo`);

--
-- Indexes for table `macrorregiao`
--
ALTER TABLE `macrorregiao`
  ADD PRIMARY KEY (`idMacrorregiao`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`idMaterial`);

--
-- Indexes for table `material_tipo`
--
ALTER TABLE `material_tipo`
  ADD PRIMARY KEY (`idTipoMaterial`);

--
-- Indexes for table `matricula_importada_alexandria`
--
ALTER TABLE `matricula_importada_alexandria`
  ADD PRIMARY KEY (`idMatriculaImportadaAlexandria`),
  ADD KEY `matriculaalexandria_equipamento_fk_idx` (`idEquipamento`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD PRIMARY KEY (`idNivelAcesso`);

--
-- Indexes for table `ocorrencia_equipamento`
--
ALTER TABLE `ocorrencia_equipamento`
  ADD PRIMARY KEY (`idOcorrenciaEquipamento`),
  ADD KEY `ocorrenciaequipamento_equipamento_fk_idx` (`idEquipamento`);

--
-- Indexes for table `padrao`
--
ALTER TABLE `padrao`
  ADD PRIMARY KEY (`idPadrao`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `porte`
--
ALTER TABLE `porte`
  ADD PRIMARY KEY (`idPorte`);

--
-- Indexes for table `programacao_cultural`
--
ALTER TABLE `programacao_cultural`
  ADD PRIMARY KEY (`idProgramacaoCultural`),
  ADD KEY `programacaocultural_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `programacaocultural_tipoevento_fk_idx` (`idTipoEvento`),
  ADD KEY `programacaocultural_formacontratacao_fk_idx` (`idFormaContratacao`),
  ADD KEY `programacaocultural_projetoespecial_fk_idx` (`idProjetoEspecial`),
  ADD KEY `programacaocultural_servidor_idx` (`rfFuncionario`);

--
-- Indexes for table `programacao_cultural_data`
--
ALTER TABLE `programacao_cultural_data`
  ADD PRIMARY KEY (`idProgramacaoCulturalData`),
  ADD KEY `programacaoculturaldata_programacaocultural_fk_idx` (`idProgramacaoCultural`);

--
-- Indexes for table `programacao_cultural_frequencia`
--
ALTER TABLE `programacao_cultural_frequencia`
  ADD PRIMARY KEY (`idProgramacaoCulturalFrequencia`),
  ADD KEY `programacaoculturalfrequencia_programacaoculturaldata_fk_idx` (`idProgramacaoCulturalData`),
  ADD KEY `programacaoculturalfrequencia_programacaocultural_fk_idx` (`idProgramacaoCultural`),
  ADD KEY `programacaoculturalfrequencia_categoriaetaria_fk_idx` (`idCategoriaEtaria`);

--
-- Indexes for table `projeto_especial`
--
ALTER TABLE `projeto_especial`
  ADD PRIMARY KEY (`idProjetoEspecial`);

--
-- Indexes for table `regiao`
--
ALTER TABLE `regiao`
  ADD PRIMARY KEY (`idRegiao`);

--
-- Indexes for table `regional`
--
ALTER TABLE `regional`
  ADD PRIMARY KEY (`idRegional`);

--
-- Indexes for table `responsavel_equipamento`
--
ALTER TABLE `responsavel_equipamento`
  ADD PRIMARY KEY (`idResponsavelEquipamento`),
  ADD KEY `responsavelequipamento_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `responsavelequipamento_responsabilidadetipo_fk_idx` (`idTipoResponsabilidade`),
  ADD KEY `responsavelequipamento_servidor_fk_idx` (`rfFuncionario`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `secretaria`
--
ALTER TABLE `secretaria`
  ADD PRIMARY KEY (`idSecretaria`);

--
-- Indexes for table `servico_extensao`
--
ALTER TABLE `servico_extensao`
  ADD PRIMARY KEY (`idServicoExtensao`),
  ADD KEY `servicoextensao_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `servicoextensao_categoriaetaria_fk_idx` (`idCategoriaEtaria`),
  ADD KEY `servicoextensao_servidor_idx` (`rfOperador`);

--
-- Indexes for table `servico_tipo`
--
ALTER TABLE `servico_tipo`
  ADD PRIMARY KEY (`idTipoServico`);

--
-- Indexes for table `servidor`
--
ALTER TABLE `servidor`
  ADD PRIMARY KEY (`rfServidor`),
  ADD KEY `servidor_cargo_fk_idx` (`idCargo`),
  ADD KEY `servidor_funcao_fk_idx` (`idFuncao`),
  ADD KEY `servidor_escolaridade_fk_idx` (`idEscolaridade`),
  ADD KEY `servidor_secretaria_fk_idx` (`idSecretaria`),
  ADD KEY `servidor_subordinacaoadministrativa_fk_idx` (`idSubordinacaoAdministrativa`);

--
-- Indexes for table `servidor_convocado`
--
ALTER TABLE `servidor_convocado`
  ADD PRIMARY KEY (`idServidorConvocado`),
  ADD KEY `servidorconvocado_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `servidorconvocado_servidor_fk_idx` (`rfServidor`),
  ADD KEY `servidorconvocado_servidoroperador_fk_idx` (`rfOperador`);

--
-- Indexes for table `servidor_lotado_equipamento`
--
ALTER TABLE `servidor_lotado_equipamento`
  ADD PRIMARY KEY (`idServidorLotadoEquipamento`),
  ADD KEY `servidorlotadoequipamento_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `servidorlotadoequipamento_servidor_fk_idx` (`rfServidor`);

--
-- Indexes for table `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`idSexo`);

--
-- Indexes for table `status_equipamento`
--
ALTER TABLE `status_equipamento`
  ADD PRIMARY KEY (`idStatusEquipamento`);

--
-- Indexes for table `subordinacao_administrativa`
--
ALTER TABLE `subordinacao_administrativa`
  ADD PRIMARY KEY (`idSubordinacaoAdministrativa`);

--
-- Indexes for table `subprefeitura`
--
ALTER TABLE `subprefeitura`
  ADD PRIMARY KEY (`idSubPrefeitura`);

--
-- Indexes for table `terceirizada_quantidade`
--
ALTER TABLE `terceirizada_quantidade`
  ADD PRIMARY KEY (`idTerceirizadaQuantidade`),
  ADD KEY `terceirizadaquantidade_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `terceirizadaquantidade_terceirizadatipo_fk_idx` (`idTipoTerceirizada`);

--
-- Indexes for table `terceirizada_tipo`
--
ALTER TABLE `terceirizada_tipo`
  ADD PRIMARY KEY (`idTerceirizadaTipo`);

--
-- Indexes for table `tipo_evento`
--
ALTER TABLE `tipo_evento`
  ADD PRIMARY KEY (`idTipoEvento`);

--
-- Indexes for table `tipo_responsabilidade`
--
ALTER TABLE `tipo_responsabilidade`
  ADD PRIMARY KEY (`idTipoResponsabilidade`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `usuario_tipodocumento_fk_idx` (`idTipoDocumento`),
  ADD KEY `usuario_sexo_fk_idx` (`idSexo`),
  ADD KEY `usuario_escolaridade_fk_idx` (`idEscolaridade`),
  ADD KEY `usuario_etnia_idx` (`idEtnia`),
  ADD KEY `usuario_deficiencia_fk_idx` (`idDeficiencia`),
  ADD KEY `usuario_faixaetaria_fk_idx` (`idFaixaEtaria`),
  ADD KEY `usuario_servidor_fk_idx` (`rfOperador`);

--
-- Indexes for table `usuario_servico`
--
ALTER TABLE `usuario_servico`
  ADD PRIMARY KEY (`idUsuarioServico`),
  ADD KEY `usuarioservico_equipamento_fk_idx` (`idEquipamento`),
  ADD KEY `usuarioservico_matriculaalexandria_fk_idx` (`idMatriculaImportadaAlexandria`),
  ADD KEY `usuarioservico_servidor_fk_idx` (`rfOperador`);

--
-- Indexes for table `utilizacao`
--
ALTER TABLE `utilizacao`
  ADD PRIMARY KEY (`idUtilizacao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acervo_alexandria`
--
ALTER TABLE `acervo_alexandria`
  MODIFY `idAcervoAlexandria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acervo_forma_documento`
--
ALTER TABLE `acervo_forma_documento`
  MODIFY `idAcervoFormaDocumento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acervo_forma_movimentacao`
--
ALTER TABLE `acervo_forma_movimentacao`
  MODIFY `idAcervoFormaMovimentacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acervo_movimentacao`
--
ALTER TABLE `acervo_movimentacao`
  MODIFY `idAcervoMovimentacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acervo_quantidade`
--
ALTER TABLE `acervo_quantidade`
  MODIFY `idAcervoQuantidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acessibilidade_arquitetonica`
--
ALTER TABLE `acessibilidade_arquitetonica`
  MODIFY `idAcessibilidadeArquitetonica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `atendimento_recepcao`
--
ALTER TABLE `atendimento_recepcao`
  MODIFY `idAtendimentoRecepcao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idCargo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoria_etaria`
--
ALTER TABLE `categoria_etaria`
  MODIFY `idCategoriaEtaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classificacao_area_externa`
--
ALTER TABLE `classificacao_area_externa`
  MODIFY `idClassificacaoAreaExterna` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contrato_uso`
--
ALTER TABLE `contrato_uso`
  MODIFY `idContratoUso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `controle_acesso`
--
ALTER TABLE `controle_acesso`
  MODIFY `idControleAcesso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custo_evento_igsis`
--
ALTER TABLE `custo_evento_igsis`
  MODIFY `idCustoEventoIgsis` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deficiencia`
--
ALTER TABLE `deficiencia`
  MODIFY `idDeficiencia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `despesa_categoria`
--
ALTER TABLE `despesa_categoria`
  MODIFY `idDespesaCategoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `despesa_financeira`
--
ALTER TABLE `despesa_financeira`
  MODIFY `idDespesaFinanceira` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `despesa_tipo`
--
ALTER TABLE `despesa_tipo`
  MODIFY `idDespesaTipo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `idDistrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documento_tipo`
--
ALTER TABLE `documento_tipo`
  MODIFY `idTipoDocumento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idEndereco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `idEquipamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipamento_sigla`
--
ALTER TABLE `equipamento_sigla`
  MODIFY `idSigla` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `escolaridade`
--
ALTER TABLE `escolaridade`
  MODIFY `idEscolaridade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `etnia`
--
ALTER TABLE `etnia`
  MODIFY `idEtnia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faixa_etaria`
--
ALTER TABLE `faixa_etaria`
  MODIFY `idFaixaEtaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forma_contratacao`
--
ALTER TABLE `forma_contratacao`
  MODIFY `idFormaContratacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcao`
--
ALTER TABLE `funcao`
  MODIFY `idFuncao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcionamento`
--
ALTER TABLE `funcionamento`
  MODIFY `idFuncionamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legislacao`
--
ALTER TABLE `legislacao`
  MODIFY `idLegislacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legislacao_equipamento`
--
ALTER TABLE `legislacao_equipamento`
  MODIFY `idLegislacaoEquipamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legislacao_tipo`
--
ALTER TABLE `legislacao_tipo`
  MODIFY `idLegislacaoTipo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `macrorregiao`
--
ALTER TABLE `macrorregiao`
  MODIFY `idMacrorregiao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `idMaterial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_tipo`
--
ALTER TABLE `material_tipo`
  MODIFY `idTipoMaterial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matricula_importada_alexandria`
--
ALTER TABLE `matricula_importada_alexandria`
  MODIFY `idMatriculaImportadaAlexandria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ocorrencia_equipamento`
--
ALTER TABLE `ocorrencia_equipamento`
  MODIFY `idOcorrenciaEquipamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `padrao`
--
ALTER TABLE `padrao`
  MODIFY `idPadrao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `porte`
--
ALTER TABLE `porte`
  MODIFY `idPorte` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programacao_cultural`
--
ALTER TABLE `programacao_cultural`
  MODIFY `idProgramacaoCultural` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programacao_cultural_data`
--
ALTER TABLE `programacao_cultural_data`
  MODIFY `idProgramacaoCulturalData` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programacao_cultural_frequencia`
--
ALTER TABLE `programacao_cultural_frequencia`
  MODIFY `idProgramacaoCulturalFrequencia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projeto_especial`
--
ALTER TABLE `projeto_especial`
  MODIFY `idProjetoEspecial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regiao`
--
ALTER TABLE `regiao`
  MODIFY `idRegiao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `regional`
--
ALTER TABLE `regional`
  MODIFY `idRegional` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `responsavel_equipamento`
--
ALTER TABLE `responsavel_equipamento`
  MODIFY `idResponsavelEquipamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `secretaria`
--
ALTER TABLE `secretaria`
  MODIFY `idSecretaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servico_extensao`
--
ALTER TABLE `servico_extensao`
  MODIFY `idServicoExtensao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servico_tipo`
--
ALTER TABLE `servico_tipo`
  MODIFY `idTipoServico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `servidor_convocado`
--
ALTER TABLE `servidor_convocado`
  MODIFY `idServidorConvocado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servidor_lotado_equipamento`
--
ALTER TABLE `servidor_lotado_equipamento`
  MODIFY `idServidorLotadoEquipamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sexo`
--
ALTER TABLE `sexo`
  MODIFY `idSexo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_equipamento`
--
ALTER TABLE `status_equipamento`
  MODIFY `idStatusEquipamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subordinacao_administrativa`
--
ALTER TABLE `subordinacao_administrativa`
  MODIFY `idSubordinacaoAdministrativa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subprefeitura`
--
ALTER TABLE `subprefeitura`
  MODIFY `idSubPrefeitura` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terceirizada_quantidade`
--
ALTER TABLE `terceirizada_quantidade`
  MODIFY `idTerceirizadaQuantidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terceirizada_tipo`
--
ALTER TABLE `terceirizada_tipo`
  MODIFY `idTerceirizadaTipo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_evento`
--
ALTER TABLE `tipo_evento`
  MODIFY `idTipoEvento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_responsabilidade`
--
ALTER TABLE `tipo_responsabilidade`
  MODIFY `idTipoResponsabilidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario_servico`
--
ALTER TABLE `usuario_servico`
  MODIFY `idUsuarioServico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilizacao`
--
ALTER TABLE `utilizacao`
  MODIFY `idUtilizacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `acervo_alexandria`
--
ALTER TABLE `acervo_alexandria`
  ADD CONSTRAINT `acervoalexandria_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervoalexandria_material_fk` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervoalexandria_materialtipo_fk` FOREIGN KEY (`idTipoMaterial`) REFERENCES `material_tipo` (`idTipoMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `acervo_forma_movimentacao`
--
ALTER TABLE `acervo_forma_movimentacao`
  ADD CONSTRAINT `acervoformamovimentacao_acervoformadocumento_fk` FOREIGN KEY (`idFormaDocumentoAcervo`) REFERENCES `acervo_forma_documento` (`idAcervoFormaDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervoformamovimentacao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervoformamovimentacao_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `acervo_movimentacao`
--
ALTER TABLE `acervo_movimentacao`
  ADD CONSTRAINT `acervomovimentacao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervomovimentacao_material_fk` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervomovimentacao_materialtipo_fk` FOREIGN KEY (`idTipoMaterial`) REFERENCES `material_tipo` (`idTipoMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervomovimentacao_servidor` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `acervo_quantidade`
--
ALTER TABLE `acervo_quantidade`
  ADD CONSTRAINT `acervoquantidade_acervoalexandria_fk` FOREIGN KEY (`idAcervoAlexandria`) REFERENCES `acervo_alexandria` (`idAcervoAlexandria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervoquantidade_material_fk` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervoquantidade_materialtipo_fk` FOREIGN KEY (`idTipoMaterial`) REFERENCES `material_tipo` (`idTipoMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervoquantidade_servidor` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acervoquantitade_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `atendimento_recepcao`
--
ALTER TABLE `atendimento_recepcao`
  ADD CONSTRAINT `atendimentorecepcao_deficiencia_fk` FOREIGN KEY (`idDeficiencia`) REFERENCES `deficiencia` (`idDeficiencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `atendimentorecepcao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `atendimentorecepcao_escolaridade_fk` FOREIGN KEY (`idEscolaridade`) REFERENCES `escolaridade` (`idEscolaridade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `atendimentorecepcao_etnia_fk` FOREIGN KEY (`idEtnia`) REFERENCES `etnia` (`idEtnia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `atendimentorecepcao_faixaetaria_fk` FOREIGN KEY (`idFaixaEtaria`) REFERENCES `faixa_etaria` (`idFaixaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `atendimentorecepcao_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `atendimentorecepcao_sexo_fk` FOREIGN KEY (`idSexo`) REFERENCES `sexo` (`idSexo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `atendimentorecepcao_usuario_fk` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `controle_acesso`
--
ALTER TABLE `controle_acesso`
  ADD CONSTRAINT `controleacesso_funcionalidadesacesso_fk` FOREIGN KEY (`idFuncionalidadesAcesso`) REFERENCES `funcionalidades_acesso` (`idFuncionalidadesAcesso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `controleacesso_nivelacesso` FOREIGN KEY (`idNivelAcesso`) REFERENCES `nivel_acesso` (`idNivelAcesso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `controleacesso_servidor_fk` FOREIGN KEY (`rfServidor`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `custo_evento_igsis`
--
ALTER TABLE `custo_evento_igsis`
  ADD CONSTRAINT `custoeventoigsis_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `custoeventoigsis_formacontratacao_fk` FOREIGN KEY (`idFormaContratacao`) REFERENCES `forma_contratacao` (`idFormaContratacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `custoeventoigsis_programacaocultural_fk` FOREIGN KEY (`idProgramacaoCultural`) REFERENCES `programacao_cultural` (`idProgramacaoCultural`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `dados_edificacao`
--
ALTER TABLE `dados_edificacao`
  ADD CONSTRAINT `dadosedificacao_acessibilidadearquitetonica_fk` FOREIGN KEY (`idAcessibilidadeArquitetonica`) REFERENCES `acessibilidade_arquitetonica` (`idAcessibilidadeArquitetonica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dadosedificacao_classificacaoareaexterna_fk` FOREIGN KEY (`idClassificacaoAreaExterna`) REFERENCES `classificacao_area_externa` (`idClassificacaoAreaExterna`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dadosedificacao_contratouso_fk` FOREIGN KEY (`idContratoUso`) REFERENCES `contrato_uso` (`idContratoUso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dadosedificacao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dadosedificacao_padrao_fk` FOREIGN KEY (`idPadrao`) REFERENCES `padrao` (`idPadrao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dadosedificacao_porte_fk` FOREIGN KEY (`idPorte`) REFERENCES `porte` (`idPorte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dadosedificacao_utilizacao_fk` FOREIGN KEY (`idUtilizacao`) REFERENCES `utilizacao` (`idUtilizacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `despesa_financeira`
--
ALTER TABLE `despesa_financeira`
  ADD CONSTRAINT `despesafinanceira_despesatipo_fk` FOREIGN KEY (`idDespesaTipo`) REFERENCES `despesa_tipo` (`idDespesaTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `despesafinanceira_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `despesafinanceira_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `despesa_tipo`
--
ALTER TABLE `despesa_tipo`
  ADD CONSTRAINT `despesatipo_despesacategoria_fk` FOREIGN KEY (`idDespesaCategoria`) REFERENCES `despesa_categoria` (`idDespesaCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD CONSTRAINT `equipamento_distrito_fk` FOREIGN KEY (`idDistrito`) REFERENCES `distrito` (`idDistrito`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_endereco_fk` FOREIGN KEY (`idEndereco`) REFERENCES `endereco` (`idEndereco`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_equipamentosigla_fk` FOREIGN KEY (`idSigla`) REFERENCES `equipamento_sigla` (`idSigla`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_funcionamento_fk` FOREIGN KEY (`idFuncionamento`) REFERENCES `funcionamento` (`idFuncionamento`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_macroregiao_fk` FOREIGN KEY (`idMacrorregiao`) REFERENCES `macrorregiao` (`idMacrorregiao`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_regiao_fk` FOREIGN KEY (`idRegiao`) REFERENCES `regiao` (`idRegiao`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_regional` FOREIGN KEY (`idRegional`) REFERENCES `regional` (`idRegional`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_secretaria_fk` FOREIGN KEY (`idSecretaria`) REFERENCES `secretaria` (`idSecretaria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_servicotipo_fk` FOREIGN KEY (`idTipoServico`) REFERENCES `servico_tipo` (`idTipoServico`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_status_fk` FOREIGN KEY (`idStatusEquipamento`) REFERENCES `status_equipamento` (`idStatusEquipamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_subordinacaoadministrativa_fk` FOREIGN KEY (`idSubordinacaoAdministrativa`) REFERENCES `subordinacao_administrativa` (`idSubordinacaoAdministrativa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_subprefeitura_fk` FOREIGN KEY (`idSubPrefeitura`) REFERENCES `subprefeitura` (`idSubPrefeitura`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `faixa_etaria`
--
ALTER TABLE `faixa_etaria`
  ADD CONSTRAINT `faixaetaria_categoriaetaria_fk` FOREIGN KEY (`idCategoriaEtaria`) REFERENCES `categoria_etaria` (`idCategoriaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `legislacao`
--
ALTER TABLE `legislacao`
  ADD CONSTRAINT `legislacao_legislacaotipo_fk` FOREIGN KEY (`idLegislacaoTipo`) REFERENCES `legislacao_tipo` (`idLegislacaoTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `legislacao_equipamento`
--
ALTER TABLE `legislacao_equipamento`
  ADD CONSTRAINT `legislacaoequipamento_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `legislacaoequipamento_legislacao_fk` FOREIGN KEY (`idLegislacao`) REFERENCES `legislacao` (`idLegislacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `matricula_importada_alexandria`
--
ALTER TABLE `matricula_importada_alexandria`
  ADD CONSTRAINT `matriculaalexandria_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `ocorrencia_equipamento`
--
ALTER TABLE `ocorrencia_equipamento`
  ADD CONSTRAINT `ocorrenciaequipamento_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `programacao_cultural`
--
ALTER TABLE `programacao_cultural`
  ADD CONSTRAINT `programacaocultural_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `programacaocultural_formacontratacao_fk` FOREIGN KEY (`idFormaContratacao`) REFERENCES `forma_contratacao` (`idFormaContratacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `programacaocultural_projetoespecial_fk` FOREIGN KEY (`idProjetoEspecial`) REFERENCES `projeto_especial` (`idProjetoEspecial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `programacaocultural_servidor` FOREIGN KEY (`rfFuncionario`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `programacaocultural_tipoevento_fk` FOREIGN KEY (`idTipoEvento`) REFERENCES `tipo_evento` (`idTipoEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `programacao_cultural_data`
--
ALTER TABLE `programacao_cultural_data`
  ADD CONSTRAINT `programacaoculturaldata_programacaocultural_fk` FOREIGN KEY (`idProgramacaoCultural`) REFERENCES `programacao_cultural` (`idProgramacaoCultural`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `programacao_cultural_frequencia`
--
ALTER TABLE `programacao_cultural_frequencia`
  ADD CONSTRAINT `programacaoculturalfrequencia_categoriaetaria_fk` FOREIGN KEY (`idCategoriaEtaria`) REFERENCES `categoria_etaria` (`idCategoriaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `programacaoculturalfrequencia_programacaocultural_fk` FOREIGN KEY (`idProgramacaoCultural`) REFERENCES `programacao_cultural` (`idProgramacaoCultural`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `programacaoculturalfrequencia_programacaoculturaldata_fk` FOREIGN KEY (`idProgramacaoCulturalData`) REFERENCES `programacao_cultural_data` (`idProgramacaoCulturalData`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `responsavel_equipamento`
--
ALTER TABLE `responsavel_equipamento`
  ADD CONSTRAINT `responsavelequipamento_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `responsavelequipamento_responsabilidadetipo_fk` FOREIGN KEY (`idTipoResponsabilidade`) REFERENCES `tipo_responsabilidade` (`idTipoResponsabilidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `responsavelequipamento_servidor_fk` FOREIGN KEY (`rfFuncionario`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `servico_extensao`
--
ALTER TABLE `servico_extensao`
  ADD CONSTRAINT `servicoextensao_categoriaetaria_fk` FOREIGN KEY (`idCategoriaEtaria`) REFERENCES `categoria_etaria` (`idCategoriaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicoextensao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicoextensao_servidor` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servidor`
--
ALTER TABLE `servidor`
  ADD CONSTRAINT `servidor_cargo_fk` FOREIGN KEY (`idCargo`) REFERENCES `cargo` (`idCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servidor_escolaridade_fk` FOREIGN KEY (`idEscolaridade`) REFERENCES `escolaridade` (`idEscolaridade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servidor_funcao_fk` FOREIGN KEY (`idFuncao`) REFERENCES `funcao` (`idFuncao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servidor_secretaria_fk` FOREIGN KEY (`idSecretaria`) REFERENCES `secretaria` (`idSecretaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servidor_subordinacaoadministrativa_fk` FOREIGN KEY (`idSubordinacaoAdministrativa`) REFERENCES `subordinacao_administrativa` (`idSubordinacaoAdministrativa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servidor_convocado`
--
ALTER TABLE `servidor_convocado`
  ADD CONSTRAINT `servidorconvocado_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servidorconvocado_servidor_fk` FOREIGN KEY (`rfServidor`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servidorconvocado_servidoroperador_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servidor_lotado_equipamento`
--
ALTER TABLE `servidor_lotado_equipamento`
  ADD CONSTRAINT `servidorlotadoequipamento_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servidorlotadoequipamento_servidor_fk` FOREIGN KEY (`rfServidor`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `terceirizada_quantidade`
--
ALTER TABLE `terceirizada_quantidade`
  ADD CONSTRAINT `terceirizadaquantidade_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `terceirizadaquantidade_terceirizadatipo_fk` FOREIGN KEY (`idTipoTerceirizada`) REFERENCES `terceirizada_tipo` (`idTerceirizadaTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_deficiencia_fk` FOREIGN KEY (`idDeficiencia`) REFERENCES `deficiencia` (`idDeficiencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_documentotipo_fk` FOREIGN KEY (`idTipoDocumento`) REFERENCES `documento_tipo` (`idTipoDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_escolaridade_fk` FOREIGN KEY (`idEscolaridade`) REFERENCES `escolaridade` (`idEscolaridade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_etnia` FOREIGN KEY (`idEtnia`) REFERENCES `etnia` (`idEtnia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_faixaetaria_fk` FOREIGN KEY (`idFaixaEtaria`) REFERENCES `faixa_etaria` (`idFaixaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_sexo_fk` FOREIGN KEY (`idSexo`) REFERENCES `sexo` (`idSexo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario_servico`
--
ALTER TABLE `usuario_servico`
  ADD CONSTRAINT `usuarioservico_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarioservico_matriculaalexandria_fk` FOREIGN KEY (`idMatriculaImportadaAlexandria`) REFERENCES `matricula_importada_alexandria` (`idMatriculaImportadaAlexandria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarioservico_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
