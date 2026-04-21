@extends('layouts.app')

@section('header_title', 'Editar Contrato')
@section('header_subtitle', 'Modificar datos del contrato #ISP-' . \Carbon\Carbon::parse($contract->fecha)->format('Y') . '-' . str_pad($contract->id_contrato, 3, '0', STR_PAD_LEFT))

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-surface-container-lowest rounded-xl shadow-[0_24px_48px_-12px_rgba(26,28,28,0.08)] overflow-hidden">

        <!-- Header del formulario -->
        <div class="p-6 bg-surface-container-low border-b border-outline-variant/30">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-headline font-bold text-xl">Editar Contrato</h2>
                    <p class="text-sm text-on-surface-variant mt-1">
                        Cliente: <strong>{{ $contract->client->nombre ?? '—' }} {{ $contract->client->apellido ?? '' }}</strong>
                        · Cédula: <strong>{{ $contract->client->cedula ?? '—' }}</strong>
                    </p>
                </div>
                <span class="font-bold text-lg text-secondary">
                    #ISP-{{ \Carbon\Carbon::parse($contract->fecha)->format('Y') }}-{{ str_pad($contract->id_contrato, 3, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        <form action="{{ route('contracts.update', $contract->id_contrato) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <!-- Info del cliente (solo lectura) -->
            <div class="bg-surface-container rounded-lg p-4 space-y-2">
                <p class="text-xs font-semibold uppercase tracking-wider text-on-surface-variant mb-2">Datos del Cliente (solo lectura)</p>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <span class="text-outline text-xs">Nombre</span>
                        <p class="font-semibold">{{ $contract->client->nombre ?? '—' }} {{ $contract->client->apellido ?? '' }}</p>
                    </div>
                    <div>
                        <span class="text-outline text-xs">Cédula</span>
                        <p class="font-semibold">{{ $contract->client->cedula ?? '—' }}</p>
                    </div>
                    <div>
                        <span class="text-outline text-xs">Dirección</span>
                        <p class="font-semibold">{{ $contract->client->direccion ?? '—' }}</p>
                    </div>
                    <div>
                        <span class="text-outline text-xs">Operador que creó</span>
                        <p class="font-semibold">{{ $contract->user->name ?? '—' }}</p>
                    </div>
                </div>
            </div>

            <!-- Plan de internet -->
            <div>
                <label class="block text-sm font-semibold text-on-surface-variant mb-1.5" for="tipo_conexion">Tipo de Conexión</label>
                <select id="tipo_conexion"
                    class="w-full bg-surface-container border border-outline-variant rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-primary transition-all mb-3">
                    <option value="">Seleccione tipo para filtrar planes...</option>
                    @foreach($tiposConexion as $tipo)
                        <option value="{{ $tipo->id_tipo }}"
                            {{ $contract->plan && $contract->plan->id_tipo == $tipo->id_tipo ? 'selected' : '' }}>
                            {{ $tipo->nombre_tipo }}
                        </option>
                    @endforeach
                </select>

                <label class="block text-sm font-semibold text-on-surface-variant mb-1.5" for="id_plan">Plan de Internet</label>
                <select id="id_plan" name="id_plan" required
                    class="w-full bg-surface-container border border-outline-variant rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-primary transition-all @error('id_plan') border-error @enderror">
                    @foreach($tiposConexion as $tipo)
                        @foreach($tipo->plans as $plan)
                            <option value="{{ $plan->id_plan }}" {{ old('id_plan', $contract->id_plan) == $plan->id_plan ? 'selected' : '' }}>
                                {{ $tipo->nombre_tipo }} — {{ $plan->nombre_plan }} ({{ $plan->velocidad }}) · ${{ number_format($plan->precio, 2) }}/mes
                            </option>
                        @endforeach
                    @endforeach
                </select>
                @error('id_plan')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Fecha del contrato -->
            <div>
                <label class="block text-sm font-semibold text-on-surface-variant mb-1.5" for="fecha">Fecha del Contrato</label>
                <input id="fecha" name="fecha" type="date"
                    value="{{ old('fecha', \Carbon\Carbon::parse($contract->fecha)->format('Y-m-d')) }}"
                    class="w-full bg-surface-container border border-outline-variant rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-primary transition-all @error('fecha') border-error @enderror"
                    required>
                @error('fecha')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-between items-center pt-4 border-t border-outline-variant/30">
                <a href="{{ route('contracts.index') }}" class="px-5 py-2.5 rounded-lg text-sm font-semibold text-on-surface-variant hover:bg-surface-container transition-colors">
                    ← Volver
                </a>
                <button type="submit" class="bg-primary text-on-primary px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-secondary transition-all duration-300 shadow-lg shadow-primary/10">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
