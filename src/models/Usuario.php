<?php
class Usuario{
    private $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function adicionarTransacao ($usuario_id, $descricao, $valor){
        $stmt = this->db->prepare("INSERT INTO transacoes (usuario_id, descricao, valor) VALUES (?, ?, ?)");
        return $stmt->execute([$usuario_id, $descricao, $valor]);
    }

    public function listarTransacoes ($usuario_id){
        $stmt = this->db->prepare("SELECT descricao, valor FROM transacoes WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }
}
?> 