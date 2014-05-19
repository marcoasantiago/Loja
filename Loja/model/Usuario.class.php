<?php

class Usuario {

    // Atributos da Classe Usuario
    private $id;
    private $nome;
    private $apelido;
    private $cpf;
    private $dtnascimento;
    private $sexo;
    private $email;
    private $repeteEmail;
    private $senha;
    private $repetesenha;
    private $cep;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;
    private $telefone;
    private $telefone2;
                       
    // Métodos da Classe Cliente
    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }
    
    public function setNome ($nome) {
        $this->nome = $nome;
    }

    public function getNome () {
        return $this->nome;
    }
                       
    public function setApelido ($apelido) {
        $this->apelido = $apelido;
    }

    public function getApelido () {
        return $this->apelido;
    }
    
    public function setCPF ($cpf) {
        $this->cpf = $cpf;
    }

    public function getCPF () {
        return $this->cpf;
    }
    
    public function setDtNascimento ($dtnascimento) {
        $this->dtnascimento = $dtnascimento;
    }

    public function getDtNascimento () {
        return $this->dtnascimento;
    }
    
    public function setSexo ($sexo) {
        $this->sexo = $sexo;
    }

    public function getSexo () {
        return $this->sexo;
    }
    
	public function setEmail ($email) {
        $this->email = $email;
    }
    
    public function getEmail () {
        return $this->email;
    }

    
	public function setRepeteEmail ($repeteEmail) {
        $this->repeteEmail = $repeteEmail;
    }
    
    public function getRepeteEmail () {
        return $this->repeteEmail;
    }
        
    public function setSenha ($senha) {
        $this->senha = $senha;
    }

    public function getSenha () {
        return $this->senha;
    }
        
    public function setRepeteSenha ($repetesenha) {
        $this->repetesenha = $repetesenha;
    }

    public function getRepeteSenha () {
        return $this->repetesenha;
    }

    public function setCEP ($cep) {
        $this->cep = $cep;
    }

    public function getCEP () {
        return $this->cep;
    }
    
    public function setEndereco ($endereco) {
        $this->endereco = $endereco;
    }

    public function getEndereco () {
        return $this->endereco;
    }
    
    public function setNumero ($numero) {
        $this->numero = $numero;
    }

    public function getNumero () {
        return $this->numero;
    }

    public function setComplemento ($complemento) {
        $this->complemento = $complemento;
    }

    public function getComplemento () {
        return $this->complemento;
    }
        
    public function setBairro ($bairro) {
        $this->bairro = $bairro;
    }

    public function getBairro () {
        return $this->bairro;
    }
    
    public function setCidade ($cidade) {
        $this->cidade = $cidade;
    }

    public function getCidade () {
        return $this->cidade;
    }
    
    public function setEstado ($estado) {
        $this->estado = $estado;
    }

    public function getEstado () {
        return $this->estado;
    }
    
    public function setTelefone ($telefone) {
        $this->telefone = $telefone;
    }

    public function getTelefone () {
        return $this->telefone;
    }
    
    public function setTelefone2 ($telefone2) {
        $this->telefone2 = $telefone2;
    }

    public function getTelefone2 () {
        return $this->telefone2;
    }
    
}
?>