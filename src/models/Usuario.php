<?php
class Usuario{
    private $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function adicionarTransacao ($usuario_id, $descricao, $valor){
        $stmt = $this->db->prepare("INSERT INTO transacoes (usuario_id, descricao, valor) VALUES (?, ?, ?)");
        return $stmt->execute([$usuario_id, $descricao, $valor]);
    }

    public function listarTransacoes ($usuario_id){
        $stmt = $this->db->prepare("SELECT descricao, valor FROM transacoes WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }

    public function verificarCredenciais ($email, $senha_pura){
        $stmt = $this->db->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if($user && password_verify($senha_pura, $user ['senha'])){
            return[
                'id' => $user['id'],
                'nome' => $user['nome']
            ];
        }
        return false;
    }

    public function cadastrarUsuario($nome, $email, $senha_pura) {
        $senha_hash = password_hash($senha_pura, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $email, $senha_hash]);
    }
}
