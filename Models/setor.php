<?php 
class Setor
{
    private int $id;
    private string $descricao;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setDescricao(string $desc)
    {
        $this->descricao = $desc;
    }

    public function getDescricao() : string
    {
        return $this->descricao;
    }
}
?>