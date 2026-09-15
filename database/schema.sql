-- 1. Criação do Banco de Dados (Opcional)
CREATE DATABASE IF NOT EXISTS techdesk DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE techdesk;

-- 2. Tabela de Usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL, -- Armazenará a hash BCRYPT
    perfil ENUM('usuario', 'operacional', 'suporte', 'admin') NOT NULL DEFAULT 'usuario',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabela de Categorias
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabela de Chamados
CREATE TABLE IF NOT EXISTS chamados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    categoria_id INT NOT NULL,
    tecnico_id INT NULL, -- Pode ser nulo até um técnico assumir
    titulo VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    prioridade ENUM('Baixa', 'Média', 'Alta') NOT NULL DEFAULT 'Média',
    status ENUM('Aberto', 'Em Atendimento', 'Concluído', 'Cancelado') NOT NULL DEFAULT 'Aberto',
    arquivo_anexo VARCHAR(255) NULL, -- Caminho do arquivo salvo no servidor
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Chaves Estrangeiras (Relacionamentos)
    CONSTRAINT fk_chamados_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_chamados_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT,
    CONSTRAINT fk_chamados_tecnico FOREIGN KEY (tecnico_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==============================================================================
-- DADOS INICIAIS DE TESTE (SEEDS)
-- ==============================================================================

-- Categorias Padrão
INSERT INTO categorias (nome) VALUES 
('Hardware'),
('Software'),
('Redes e Internet'),
('Acessos e Permissões');

-- Usuários de Teste (Senha para todos: "123456" hasheada em BCRYPT)
INSERT INTO usuarios (nome, email, senha, perfil) VALUES 
('João Solicitante', 'joao@empresa.com', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1T9D4G2836TEx4qA.hJbBfEx21A0lGy', 'usuario'),
('Maria Técnica', 'maria@empresa.com', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1T9D4G2836TEx4qA.hJbBfEx21A0lGy', 'usuario');

-- Chamados de Exemplo
INSERT INTO chamados (usuario_id, categoria_id, tecnico_id, titulo, descricao, prioridade, status) VALUES 
(1, 1, NULL, 'Impressora não conecta na rede', 'A impressora do setor financeiro parou de responder via IP.', 'Média', 'Aberto'),
(2, 2, NULL, 'Erro 500 no sistema interno', 'Ao tentar gerar o relatório mensal, o sistema exibe tela branca com erro HTTP 500.', 'Alta', 'Em Atendimento');