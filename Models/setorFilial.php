<?php 
class SetorFilial
{
    private int $setor_id;
    private int $filial_id;

    public function setSetorId(int $id)
    {
        $this->setor_id = $id;
    }

    public function getSetorId() : int
    {
        return $this->setor_id;
    }

    public function setFilialId(int $id)
    {
        $this->filial_id = $id;
    }

    public function getFilialId() : int
    {
        return $this->filial_id;
    }
}
?>