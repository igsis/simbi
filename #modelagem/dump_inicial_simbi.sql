--
-- Database: `dbsimbi`
--

--
-- Extraindo dados da tabela `macrorregiao`
--

INSERT INTO `macrorregiao` (`idMacrorregiao`, `descricao`) VALUES
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

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_07_144747_create_permission_tables', 1);

--
-- Extraindo dados da tabela `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
(1, 1, 'Simbi\\User'),
(2, 2, 'Simbi\\User'),
(3, 3, 'Simbi\\User');

--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'web', '2018-03-02 16:19:05', '2018-03-02 16:19:05'),
(2, 'Coordenador', 'web', '2018-03-02 16:19:44', '2018-03-02 16:19:44'),
(3, 'Funcionario', 'web', '2018-03-02 16:19:52', '2018-03-02 16:19:52');

--
-- Extraindo dados da tabela `regiao`
--

INSERT INTO `regiao` (`idRegiao`, `descricao`) VALUES
(1, 'Norte'),
(2, 'Sul'),
(3, 'Leste'),
(4, 'Oeste'),
(5, 'Centro');

--
-- Extraindo dados da tabela `regional`
--

INSERT INTO `regional` (`idRegional`, `descricao`) VALUES
(1, 'Norte'),
(2, 'Sul'),
(3, 'Leste 1'),
(4, 'Leste 2'),
(5, 'Oeste'),
(6, 'Centro');

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'web', '2018-03-02 16:18:52', '2018-03-02 16:18:52'),
(2, 'Coordenador', 'web', '2018-03-02 16:19:23', '2018-03-02 16:19:23'),
(3, 'Funcionario', 'web', '2018-03-02 16:19:29', '2018-03-02 16:19:29');

--
-- Extraindo dados da tabela `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 3);

--
-- Extraindo dados da tabela `servico_tipo`
--

INSERT INTO `servico_tipo` (`idTipoServico`, `descricao`) VALUES
(1, 'Bibliotecas CSMB'),
(2, 'Bosque da Leitura'),
(3, 'Ponto de Leitura'),
(4, 'Ônibus Biblioteca'),
(5, 'Caixa'),
(6, 'Estante'),
(7, 'Feira de Troca');

--
-- Extraindo dados da tabela `subordinacao_administrativa`
--

INSERT INTO `subordinacao_administrativa` (`idSubordinacaoAdministrativa`, `descricao`) VALUES
(1, 'CAF'),
(2, 'CSMB');

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `ativo`) VALUES
(1, 'Admin', 'admin@exemplo.com', '$2y$10$zGaLJXEq9WnpbpGXsmQbpOy/AWGxoSVk50sy2VfuGLvudq6rXc77m', '1Af3zxid9amowcnaQB23vC6HFlgcLc2bvCjmipWmRf1prHPzUzalEZhLJFfN', '2018-03-02 16:09:26', '2018-03-02 16:09:26', 1),
(2, 'Coordenador', 'coord@exemplo.com', '$2y$10$1OjQ93gp9re3a0epbbwsxuw69w43LrReCa0YJQi3HSymq8AL4olA.', 'UfMpZsDJRlCJI7E7kWln9orYJ3ttnjHH27xL5UAAOU8TYiFdCo5k9dk4gaic', '2018-03-02 16:09:57', '2018-03-02 16:09:57', 1),
(3, 'Funcionario', 'func@exemplo.com', '$2y$10$xWyJfL32vB57NsL3ikRDd.G.yUq4nrGX13K2pz25vDnZmSwT1BUdS', 'FDvx92mNgnLuMMoSttKQYXctrzphIqqD06ah8RD0kursb83jyNqAgFnFBTl0', '2018-03-02 16:10:17', '2018-03-02 16:10:17', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
