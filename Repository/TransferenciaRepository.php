<?php 
class TransferenciaRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    public function salvar(Transferencia $transf) : void
    {
        $id_ativo = $transf->getIdAtivo();
        $id_filial_origem = $transf->getIdFilialOrigem();
        $id_filial_dest = $transf->getIdFilialDestino();
        $id_setor_origem = $transf->getIdSetorOrigem();
        $id_setor_dest = $transf->getIdSetorDestino();
        $data_transf = $transf->getData();

        $query = "
            INSERT INTO TRANSFERENCIA (ATIVO_ID, FILIAL_ORIGEM_ID, SETOR_ORIGEM_ID, FILIAL_DESTINO_ID, SETOR_DESTINO_ID, DATA_TRANSFERENCIA)
            VALUES
            (
                :id_ativo,
                :id_filial_origem,
                :id_setor_origem,
                :id_filial_dest,
                :id_setor_dest,
                :data_transf
            )
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':id_ativo' => $id_ativo,
            ':id_filial_origem' => $id_filial_origem,
            ':id_setor_origem' => $id_setor_origem,
            ':id_filial_dest' => $id_filial_dest,
            ':id_setor_dest' => $id_setor_dest,
            ':data_transf' => $data_transf 
        ]);
    }

    public function atualizar(Transferencia $transf) : void
    {
        $id = $transf->getId();
        $id_ativo = $transf->getIdAtivo();
        $id_filial_origem = $transf->getIdFilialOrigem();
        $id_filial_dest = $transf->getIdFilialDestino();
        $id_setor_origem = $transf->getIdSetorOrigem();
        $id_setor_dest = $transf->getIdSetorDestino();
        $data_transf = $transf->getData();

        $query = "
            UPDATE TRANSFERENCIA SET
               ATIVO_ID = :id_ativo,
               FILIAL_ORIGEM_ID = :id_filial_origem,
               SETOR_ORIGEM_ID = :id_setor_origem,
               FILIAL_DESTINO_ID = :id_filial_dest,
               SETOR_DESTINO_ID = :id_setor_dest,
               DATA_TRANSFERENCIA = :data_transf
            WHERE ID = :id
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':id_ativo' => $id_ativo,
            ':id_filial_origem' => $id_filial_origem,
            ':id_setor_origem' => $id_setor_origem,
            ':id_filial_dest' => $id_filial_dest,
            ':id_setor_dest' => $id_setor_dest,
            ':data_transf' => $data_transf,
            ':id' => $id
        ]);
    }

    public function remover(int $id) : bool
    {
        $query = "DELETE FROM TRANSFERENCIA WHERE ID = :id";

        $stmt = $this->bd->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function buscar(int $id) : Transferencia|array|null
    {
        if ($id > 0)
        {
            return $this->buscarTransf($id);
        }
        else
        {
            return $this->buscarTudo();
        }
    }

    private function buscarTransf(int $id) : ?Transferencia
    {
        $query = "SELECT * FROM TRANSFERENCIA WHERE ID = :id";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([':id' => $id]);

        $transf = $stmt->fetchObject('Transferencia');

        return $transf === false ? null : $transf;
    }

    private function buscarTudo() : ?array
    {
        $query = "SELECT * FROM TRANSFERENCIA";

        $stmt = $this->bd->query($query);
        
        $transferencias = [];

        while ($transf = $stmt->fetchObject('Transferencia'))
        {
            $transferencias[] = $transf;
        }

        return count($transferencias) > 0 ? $transferencias : null;
    }
}
?>