INSERT INTO simbi.equipamento_siglas (id, sigla, descricao, roteiro) VALUES
(1, 'BMA', 'Biblioteca Mario de Andrade', null),
(2, 'BML', 'Biblioteca Monteiro Lobato', null);

INSERT INTO simbi.secretarias (id, sigla, descricao) VALUES
(1, 'SMC', 'Secretaria Municipal da Cultura');

INSERT INTO simbi.subordinacao_administrativas (id, descricao) VALUES
(1, 'Teste Sub. Administrativa');

INSERT INTO simbi.enderecos (id, cep, logradouro, numero, complemento, bairro, cidade, estado, prefeitura_regional_id, distrito_id, macrorregiao_id, regiao_id, regional_id) VALUES
(1, '01302-000', 'Rua da Consolação', 94, null, 'Consolação', 'São Paulo', 'SP', 1, 1, 1, 5, 6),
(2, '01223-011', 'Rua General Jardim', 485, null, 'Vila Buarque', 'São Paulo', 'SP', 29, 69, 1, 5, 6);

INSERT INTO simbi.equipamentos (id, nome, tipo_servico_id, equipamento_sigla_id, secretaria_id, subordinacao_administrativa_id, tematico, nome_tematica, endereco_id, telefone, telecentro, acervo_especializado, nucleo_braile, status_id, publicado) VALUES
(1, 'Biblioteca Mario de Andrade', 1, 1, 1, 1, 0, null, 1, '(11) 3775-0002', 0, 0, 0, 1, 1),
(2, 'Biblioteca Monteiro Lobato', 1, 2, 1, 1, 0, null, 2, '(11) 3256-4122', 1, 0, 0, 1, 1);