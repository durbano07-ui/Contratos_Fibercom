<?php

namespace App\Services;

use App\Models\Contract;

class ContractService
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Procesa la creación completa de un contrato, asegurando la existencia del cliente.
     */
    public function createContract(array $data, $userId, $idTecnico = null)
    {
        // 1. Obtener o crear el cliente
        $client = $this->clientService->findOrCreateClient($data['client']);

        $contract = Contract::create([
            'id_usuario'         => $userId,
            'id_tecnico'         => $idTecnico ?: null,
            'id_cliente'         => $client->id_cliente,
            'id_plan'            => $data['contract']['id_plan'],
            'direccion_servicio' => $data['contract']['direccion_servicio'] ?? null,
            'metodo_pago'        => $data['contract']['payment'] ?? 'direct',
            'duracion'           => $data['contract']['duration'] ?? '24',
            'beneficio_ley'      => $data['contract']['beneficio_ley'] ?? 0,
            'fecha'              => now()->toDateString(),
            'hora_creacion'      => now()->toTimeString(),
            'pdf_ruta'           => null,
            'estado_anexo2'      => 'pendiente',
        ]);

        return $contract;
    }

    /**
     * Guarda la ruta del PDF generado en la BD.
     */
    public function savePdfPath(Contract $contract, $path)
    {
        $contract->pdf_ruta = $path;
        $contract->save();
        return $contract;
    }
}
