@extends('layouts.app')

@section('title', 'Llenar Anexo 2 | Fibercom')
@section('header_title', 'Anexo 2: Equipos e Instalación')
@section('header_subtitle', 'Contrato #ISP-' . $contract->id_contrato . ' | Cliente: ' . $contract->client->nombre)

@push('styles')
    <style>
        /* ================================================
           ACORDEÓN DE SECCIONES
        ================================================ */
        .section-card {
            background: #fff;
            border: 1px solid #c4c7c7;
            border-radius: 0.5rem;
            overflow: hidden;
            transition: box-shadow 0.2s ease;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem;
            cursor: pointer;
            user-select: none;
            gap: 1rem;
            background: #f3f3f4;
            transition: background 0.15s ease;
            -webkit-tap-highlight-color: transparent;
        }

        .section-header:hover {
            background: #e8e8e8;
        }

        .section-header.active {
            background: #0a0a0a;
            color: #fff;
        }

        .section-header .section-num {
            font-size: 1.5rem;
            font-weight: 300;
            opacity: 0.35;
            line-height: 1;
            min-width: 2.5rem;
        }

        .section-header.active .section-num {
            opacity: 0.55;
        }

        .section-header .section-title {
            font-family: 'Manrope', sans-serif;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            flex: 1;
        }

        .section-chevron {
            transition: transform 0.3s ease;
            font-size: 20px !important;
        }

        .section-header.active .section-chevron {
            transform: rotate(180deg);
            color: #b6171e;
        }

        .section-status {
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            padding: 0.2rem 0.6rem;
            border-radius: 99px;
            white-space: nowrap;
        }

        .section-status.done {
            background: #dcfce7;
            color: #15803d;
        }

        .section-status.pending {
            background: #fef9c3;
            color: #a16207;
        }

        .section-status.active-badge {
            background: #b6171e;
            color: #fff;
        }

        .section-body {
            display: none;
            border-top: 1px solid #c4c7c7;
        }

        .section-body.open {
            display: block;
            animation: slideDown 0.25s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-body-inner {
            padding: 1.25rem 1.5rem;
        }

        /* ================================================
           CAMPO GENÉRICO
        ================================================ */
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .field-group label {
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #444748;
        }

        .field-group input,
        .field-group select {
            background: #fff;
            border: 1px solid #c4c7c7;
            border-radius: 0.375rem;
            padding: 0.6rem 0.75rem;
            font-size: 0.82rem;
            font-weight: 700;
            color: #1a1c1c;
            width: 100%;
            transition: border-color 0.15s, box-shadow 0.15s;
            -webkit-appearance: none;
            appearance: none;
        }

        .field-group input:focus,
        .field-group select:focus {
            outline: none;
            border-color: #b6171e;
            box-shadow: 0 0 0 3px rgba(182, 23, 30, 0.12);
        }

        .field-group input[type="number"] {
            text-align: center;
        }

        .input-with-prefix {
            position: relative;
        }

        .input-with-prefix .prefix {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 700;
            opacity: 0.35;
            pointer-events: none;
            font-size: 0.85rem;
        }

        .input-with-prefix input {
            padding-left: 1.5rem;
        }

        /* ================================================
           TARJETA DE EQUIPO (MODO SELECCIÓN)
        ================================================ */
        .equipo-card {
            background: #f9f9f9;
            border: 1.5px solid #c4c7c7;
            border-radius: 0.5rem;
            overflow: hidden;
            animation: cardIn 0.2s ease;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: scale(0.97);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Header de la tarjeta: muestra el equipo seleccionado */
        .equipo-card-head {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.9rem 1.1rem;
            background: #fff;
            border-bottom: 1px solid #e8e8e8;
        }

        .equipo-num-badge {
            width: 1.6rem;
            height: 1.6rem;
            background: #0a0a0a;
            color: #fff;
            border-radius: 0.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 900;
            flex-shrink: 0;
        }

        .equipo-selected-name {
            flex: 1;
            min-width: 0;
            font-size: 0.78rem;
            font-weight: 800;
            color: #1a1c1c;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .equipo-selected-name.placeholder-text {
            opacity: 0.35;
            font-weight: 600;
            font-style: italic;
        }

        .equipo-selected-cat {
            font-size: 0.6rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #b6171e;
            background: #fff1f1;
            padding: 0.15rem 0.5rem;
            border-radius: 99px;
            white-space: nowrap;
        }

        /* Body de la tarjeta: select + campos */
        .equipo-card-body {
            padding: 1rem 1.1rem;
        }

        /* El select de equipo tiene estilo especial */
        .equipo-select-wrap {
            margin-bottom: 0.85rem;
        }

        .equipo-catalog-select {
            width: 100%;
            background: #fff;
            border: 2px solid #c4c7c7;
            border-radius: 0.4rem;
            padding: 0.6rem 0.75rem;
            font-size: 0.8rem;
            font-weight: 700;
            color: #1a1c1c;
            -webkit-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'%3E%3Cpath fill='%23444' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2rem;
            cursor: pointer;
            transition: border-color 0.15s;
        }

        .equipo-catalog-select:focus {
            outline: none;
            border-color: #b6171e;
            box-shadow: 0 0 0 3px rgba(182, 23, 30, 0.12);
        }

        .equipo-catalog-select option[disabled] {
            color: #aaa;
            font-style: italic;
        }

        /* Grid de campos secundarios */
        .equipo-fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.65rem;
        }

        @media (min-width: 480px) {
            .equipo-fields-grid {
                grid-template-columns: 80px 1fr 120px;
            }
        }

        /* Badge de stock */
        .stock-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 0.58rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.15rem 0.5rem;
            border-radius: 99px;
        }

        .stock-ok {
            background: #dcfce7;
            color: #15803d;
        }

        .stock-low {
            background: #fef3c7;
            color: #92400e;
        }

        /* Botón eliminar tarjeta */
        .btn-remove-card {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 1.8rem;
            height: 1.8rem;
            border-radius: 0.3rem;
            border: 1px solid #ffdad6;
            background: #fff5f5;
            color: #ba1a1a;
            cursor: pointer;
            transition: background 0.15s;
            flex-shrink: 0;
        }

        .btn-remove-card:hover {
            background: #ffdad6;
        }

        .btn-remove-card .material-symbols-outlined {
            font-size: 15px !important;
        }

        /* ================================================
           CHECKBOX CARDS
        ================================================ */
        .check-card {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 1rem 1.25rem;
            background: #fff;
            border: 2px solid #c4c7c7;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: border-color 0.15s, background 0.15s;
            -webkit-tap-highlight-color: transparent;
        }

        .check-card:has(input:checked) {
            border-color: #b6171e;
            background: #fff1f1;
        }

        .check-card input[type="checkbox"] {
            width: 1.1rem;
            height: 1.1rem;
            accent-color: #b6171e;
            flex-shrink: 0;
        }

        .check-card .check-label {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #1a1c1c;
        }

        /* ================================================
           BARRA DE PROGRESO
        ================================================ */
        .progress-bar-track {
            height: 4px;
            background: #e2e2e2;
            border-radius: 99px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: #b6171e;
            border-radius: 99px;
            transition: width 0.4s ease;
        }

        /* ================================================
           BOTONES
        ================================================ */
        .btn-add {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            width: 100%;
            background: transparent;
            color: #b6171e;
            border: 1.5px dashed #b6171e;
            border-radius: 0.5rem;
            padding: 0.65rem 1rem;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            cursor: pointer;
            margin-top: 0.75rem;
            transition: background 0.15s, color 0.15s;
            -webkit-tap-highlight-color: transparent;
        }

        .btn-add:hover {
            background: #fff1f1;
        }

        .btn-add:active {
            background: #ffdad6;
        }

        .btn-add .material-symbols-outlined {
            font-size: 17px !important;
        }

        .form-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 0.9rem 1.25rem;
            border-top: 1px solid #eeeeee;
            box-shadow: 0 -4px 24px rgba(10, 10, 10, 0.10);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        @media (min-width: 1024px) {
            .form-footer {
                left: 16rem;
            }
        }

        .footer-hint {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #444748;
            flex: 1;
        }

        .footer-hint .material-symbols-outlined {
            color: #b6171e;
            font-size: 18px !important;
        }

        .btn-submit {
            background: #0a0a0a;
            color: #fff;
            padding: 0.75rem 1.75rem;
            border-radius: 0.5rem;
            font-size: 0.7rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.15s, transform 0.1s;
            box-shadow: 0 4px 16px rgba(10, 10, 10, 0.25);
        }

        .btn-submit:hover {
            background: #b6171e;
        }

        .btn-submit:active {
            transform: scale(0.97);
        }

        .inner-section-title {
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: #444748;
            margin-bottom: 0.75rem;
            padding-bottom: 0.4rem;
            border-bottom: 1px dashed #c4c7c7;
        }

        .page-wrapper {
            padding-bottom: 5rem;
        }
    </style>
@endpush

@section('content')
    {{-- Pasamos el catálogo como JSON para el JS --}}
    @php
        $catalogJson = $equipmentCatalog->map(fn($items) => $items->map(fn($e) => [
            'id' => $e->id,
            'nombre' => $e->nombre,
            'categoria' => $e->categoria,
            'stock' => $e->stock,
            'stock_minimo' => $e->stock_minimo,
            'unidad' => $e->unidad,
        ]))->toJson();
    @endphp

    <div class="max-w-2xl mx-auto page-wrapper">

        {{-- Back --}}
        <a href="{{ route('tecnico.index') }}"
            class="inline-flex items-center gap-2 mb-6 text-xs font-black uppercase tracking-widest opacity-50 hover:opacity-100 transition-opacity">
            <span class="material-symbols-outlined" style="font-size:17px;">arrow_back</span>
            Volver al Panel
        </a>

        {{-- Info card del contrato --}}
        <div class="mb-6 p-4 bg-white border border-outline-variant rounded-xl flex items-start gap-3 shadow-sm">
            <span class="material-symbols-outlined text-secondary mt-0.5"
                style="font-variation-settings:'FILL' 1; font-size:22px;">description</span>
            <div class="flex-1 min-w-0">
                <p class="text-[10px] font-black uppercase tracking-widest text-secondary mb-0.5">Contrato Asignado</p>
                <p class="font-black text-sm tracking-tight text-primary truncate">{{ $contract->client->nombre }}</p>
                <p class="text-[10px] opacity-50 font-bold uppercase">ISP-{{ $contract->id_contrato }} &middot;
                    {{ $contract->plan->nombre_plan }}</p>
            </div>
            <span
                class="px-2 py-0.5 bg-amber-100 text-amber-700 text-[9px] font-black rounded-full uppercase shrink-0">Pendiente</span>
        </div>

        {{-- Barra de progreso --}}
        <div class="mb-6">
            <div class="flex justify-between text-[9px] font-black uppercase tracking-widest opacity-50 mb-1.5">
                <span>Progreso del formulario</span>
                <span id="progress-label">0 / 2 secciones</span>
            </div>
            <div class="progress-bar-track">
                <div class="progress-bar-fill" id="progress-fill" style="width: 0%"></div>
            </div>
        </div>

        <form action="{{ route('tecnico.anexo2.store', $contract->id_contrato) }}" method="POST" id="anexo2-form">
            @csrf

            <div class="space-y-4">

                {{-- ===========================================
                SECCIÓN 01: EQUIPOS INSTALADOS
                =========================================== --}}
                <div class="section-card" data-section="equipos">
                    <div class="section-header active" onclick="toggleSection(this)">
                        <span class="section-num">01</span>
                        <span class="section-title">Equipos Instalados</span>
                        <span class="section-status active-badge" id="status-equipos">En curso</span>
                        <span class="material-symbols-outlined section-chevron">expand_more</span>
                    </div>
                    <div class="section-body open" id="body-equipos">
                        <div class="section-body-inner">

                            @if($equipmentCatalog->isEmpty())
                                <div class="text-center py-8 opacity-40">
                                    <span class="material-symbols-outlined block text-4xl mb-2">inventory_2</span>
                                    <p class="text-xs font-bold uppercase tracking-widest">No hay equipos en inventario con
                                        stock disponible.<br>Comunícate con administración.</p>
                                </div>
                            @else
                                {{-- Lista de tarjetas de equipo --}}
                                <div class="space-y-3" id="equipos-list">
                                    {{-- La primera tarjeta se renderiza directamente --}}
                                    <div class="equipo-card" id="equipo-card-0">
                                        <div class="equipo-card-head">
                                            <div class="equipo-num-badge">1</div>
                                            <span class="equipo-selected-name placeholder-text" id="eq-name-0">Selecciona un
                                                equipo...</span>
                                            <span class="equipo-selected-cat" id="eq-cat-0" style="display:none;"></span>
                                            <button type="button" class="btn-remove-card remove-equipo" title="Eliminar">
                                                <span class="material-symbols-outlined">close</span>
                                            </button>
                                        </div>
                                        <div class="equipo-card-body">
                                            {{-- Selector del catálogo --}}
                                            <div class="equipo-select-wrap">
                                                <select name="equipos[0][equipment_id]" required class="equipo-catalog-select"
                                                    onchange="onEquipoSelected(this, 0)">
                                                    <option value="" disabled selected>— Buscar en inventario —</option>
                                                    @foreach($equipmentCatalog as $categoria => $items)
                                                        <optgroup label="📦 {{ strtoupper($categoria) }}">
                                                            @foreach($items as $equipo)
                                                                <option value="{{ $equipo->id }}" data-nombre="{{ $equipo->nombre }}"
                                                                    data-categoria="{{ $equipo->categoria }}"
                                                                    data-stock="{{ $equipo->stock }}"
                                                                    data-stock-min="{{ $equipo->stock_minimo }}"
                                                                    data-unidad="{{ $equipo->unidad }}">
                                                                    {{ $equipo->nombre }} — Stock: {{ $equipo->stock }}
                                                                    {{ $equipo->unidad }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Stock badge --}}
                                            <div id="eq-stock-0" style="display:none;" class="mb-3">
                                                <span id="eq-stock-badge-0" class="stock-badge stock-ok">
                                                    <span class="material-symbols-outlined"
                                                        style="font-size:11px;">inventory</span>
                                                    <span id="eq-stock-text-0"></span>
                                                </span>
                                            </div>

                                            {{-- Campos: cantidad, serial, estado --}}
                                            <div class="equipo-fields-grid">
                                                <div class="field-group">
                                                    <label>Cantidad</label>
                                                    <input type="number" name="equipos[0][cantidad]" value="1" min="1" required>
                                                </div>
                                                <div class="field-group">
                                                    <label>N° Serial / MAC</label>
                                                    <input type="text" name="equipos[0][serial]" placeholder="Opcional">
                                                </div>
                                                <div class="field-group">
                                                    <label>Estado</label>
                                                    <select name="equipos[0][estado_equipo]" required>
                                                        <option value="Nuevo">Nuevo</option>
                                                        <option value="Usado">Usado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Botón agregar --}}
                                <button type="button" id="add-equipment" class="btn-add">
                                    <span class="material-symbols-outlined">add_circle</span>
                                    Agregar otro equipo
                                </button>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- ===========================================
                SECCIÓN 02: MODALIDAD Y VALORES
                =========================================== --}}
                <div class="section-card" data-section="modalidad">
                    <div class="section-header" onclick="toggleSection(this)">
                        <span class="section-num">02</span>
                        <span class="section-title">Modalidad y Valores</span>
                        <span class="section-status pending" id="status-modalidad">Pendiente</span>
                        <span class="material-symbols-outlined section-chevron">expand_more</span>
                    </div>
                    <div class="section-body" id="body-modalidad">
                        <div class="section-body-inner space-y-5">

                            <div>
                                <p class="inner-section-title">Tipo de Adquisición</p>
                                <div class="space-y-2.5">
                                    <label class="check-card">
                                        <input type="checkbox" name="compra_contado" value="1">
                                        <span class="check-label">Compra de Contado</span>
                                    </label>
                                    <label class="check-card">
                                        <input type="checkbox" name="arrendamiento" value="1">
                                        <span class="check-label">Arrendamiento</span>
                                    </label>
                                    <label class="check-card">
                                        <input type="checkbox" name="compra_credito" value="1">
                                        <span class="check-label">Compra a Crédito</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <p class="inner-section-title">Valores Financieros</p>
                                <div class="space-y-3">
                                    <div class="field-group">
                                        <label>Valor Mensual Arrendamiento</label>
                                        <div class="input-with-prefix">
                                            <span class="prefix">$</span>
                                            <input type="number" step="0.01" name="valor_mensual_arrendamiento"
                                                value="0.00">
                                        </div>
                                    </div>
                                    <div class="field-group">
                                        <label>Valor Mensual Pago Diferido</label>
                                        <div class="input-with-prefix">
                                            <span class="prefix">$</span>
                                            <input type="number" step="0.01" name="valor_mensual_compra_credito"
                                                value="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>{{-- fin .space-y-4 --}}
        </form>
    </div>

    {{-- Footer sticky --}}
    <footer class="form-footer">
        <div class="footer-hint">
            <span class="material-symbols-outlined">info</span>
            <span class="hidden sm:inline">Verifica los datos técnicos antes de guardar</span>
            <span class="sm:hidden">Revisa los datos</span>
        </div>
        <button type="submit" form="anexo2-form" class="btn-submit">
            Finalizar Instalación
        </button>
    </footer>
@endsection

@push('scripts')
    <script>
        const CATALOG = {!! $catalogJson !!};

        // Aplano el catálogo para búsquedas por ID
        const CATALOG_FLAT = Object.values(CATALOG).flat();

        // ------------------------------------------------
        // ACORDEÓN
        // ------------------------------------------------
        window.toggleSection = function (headerEl) {
            const body = headerEl.nextElementSibling;
            const isOpen = body.classList.contains('open');
            document.querySelectorAll('.section-body').forEach(b => b.classList.remove('open'));
            document.querySelectorAll('.section-header').forEach(h => h.classList.remove('active'));
            if (!isOpen) { body.classList.add('open'); headerEl.classList.add('active'); }
            setTimeout(updateProgress, 50);
        };

        // ------------------------------------------------
        // ACTUALIZAR HEADER DE TARJETA AL SELECCIONAR
        // ------------------------------------------------
        window.onEquipoSelected = function (selectEl, idx) {
            const opt = selectEl.options[selectEl.selectedIndex];
            const nombre = opt.dataset.nombre;
            const cat = opt.dataset.categoria;
            const stock = parseInt(opt.dataset.stock, 10);
            const min = parseInt(opt.dataset.stockMin, 10);
            const unidad = opt.dataset.unidad;

            // Nombre en el header
            const nameEl = document.getElementById(`eq-name-${idx}`);
            if (nameEl) {
                nameEl.textContent = nombre;
                nameEl.classList.remove('placeholder-text');
            }

            // Categoría badge
            const catEl = document.getElementById(`eq-cat-${idx}`);
            if (catEl) { catEl.textContent = cat; catEl.style.display = ''; }

            // Stock badge
            const stockWrap = document.getElementById(`eq-stock-${idx}`);
            const stockBadge = document.getElementById(`eq-stock-badge-${idx}`);
            const stockText = document.getElementById(`eq-stock-text-${idx}`);
            if (stockWrap && stockBadge && stockText) {
                stockWrap.style.display = '';
                stockText.textContent = `Stock: ${stock} ${unidad}`;
                stockBadge.className = 'stock-badge ' + (stock <= min ? 'stock-low' : 'stock-ok');
            }

            updateProgress();
        };

        // ------------------------------------------------
        // AGREGAR / ELIMINAR EQUIPOS DINÁMICOS
        // ------------------------------------------------
        let equipoIdx = 1;
        const equiposList = document.getElementById('equipos-list');
        const addBtn = document.getElementById('add-equipment');

        function buildOptionsHTML() {
            let html = '<option value="" disabled selected>— Buscar en inventario —</option>';
            Object.entries(CATALOG).forEach(([cat, items]) => {
                html += `<optgroup label="📦 ${cat.toUpperCase()}">`;
                items.forEach(eq => {
                    html += `<option value="${eq.id}"
                    data-nombre="${eq.nombre}"
                    data-categoria="${eq.categoria}"
                    data-stock="${eq.stock}"
                    data-stock-min="${eq.stock_minimo}"
                    data-unidad="${eq.unidad}">
                    ${eq.nombre} — Stock: ${eq.stock} ${eq.unidad}
                </option>`;
                });
                html += '</optgroup>';
            });
            return html;
        }

        function buildEquipoCard(idx) {
            const card = document.createElement('div');
            card.className = 'equipo-card';
            card.id = `equipo-card-${idx}`;
            card.innerHTML = `
            <div class="equipo-card-head">
                <div class="equipo-num-badge">${idx + 1}</div>
                <span class="equipo-selected-name placeholder-text" id="eq-name-${idx}">Selecciona un equipo...</span>
                <span class="equipo-selected-cat" id="eq-cat-${idx}" style="display:none;"></span>
                <button type="button" class="btn-remove-card remove-equipo" title="Eliminar">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="equipo-card-body">
                <div class="equipo-select-wrap">
                    <select name="equipos[${idx}][equipment_id]" required
                            class="equipo-catalog-select"
                            onchange="onEquipoSelected(this, ${idx})">
                        ${buildOptionsHTML()}
                    </select>
                </div>
                <div id="eq-stock-${idx}" style="display:none;" class="mb-3">
                    <span id="eq-stock-badge-${idx}" class="stock-badge stock-ok">
                        <span class="material-symbols-outlined" style="font-size:11px;">inventory</span>
                        <span id="eq-stock-text-${idx}"></span>
                    </span>
                </div>
                <div class="equipo-fields-grid">
                    <div class="field-group">
                        <label>Cantidad</label>
                        <input type="number" name="equipos[${idx}][cantidad]" value="1" min="1" required>
                    </div>
                    <div class="field-group">
                        <label>N° Serial / MAC</label>
                        <input type="text" name="equipos[${idx}][serial]" placeholder="Opcional">
                    </div>
                    <div class="field-group">
                        <label>Estado</label>
                        <select name="equipos[${idx}][estado_equipo]" required>
                            <option value="Nuevo">Nuevo</option>
                            <option value="Usado">Usado</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
            return card;
        }

        if (addBtn) {
            addBtn.addEventListener('click', function () {
                const card = buildEquipoCard(equipoIdx);
                equiposList.appendChild(card);
                card.querySelector('.equipo-catalog-select')?.focus();
                equipoIdx++;
                updateProgress();
            });
        }

        if (equiposList) {
            equiposList.addEventListener('click', function (e) {
                const btn = e.target.closest('.remove-equipo');
                if (!btn) return;
                const cards = equiposList.querySelectorAll('.equipo-card');
                if (cards.length <= 1) {
                    alert('Debes registrar al menos un equipo instalado.');
                    return;
                }
                btn.closest('.equipo-card').remove();
                // Re-numerar
                equiposList.querySelectorAll('.equipo-card').forEach((c, i) => {
                    const badge = c.querySelector('.equipo-num-badge');
                    if (badge) badge.textContent = i + 1;
                });
                updateProgress();
            });
        }

        // ------------------------------------------------
        // BARRA DE PROGRESO
        // ------------------------------------------------
        function isSectionDone(sectionId) {
            const body = document.getElementById('body-' + sectionId);
            if (!body) return false;
            const required = body.querySelectorAll('[required]');
            if (!required.length) return false;
            let filled = 0;
            required.forEach(inp => { if (inp.value && inp.value !== '') filled++; });
            return filled >= required.length;
        }

        function updateProgress() {
            let done = 0;
            ['equipos', 'modalidad'].forEach(sid => {
                const status = document.getElementById('status-' + sid);
                if (!status) return;
                const isActive = status.closest('.section-header').classList.contains('active');
                if (isActive) {
                    status.textContent = 'En curso';
                    status.className = 'section-status active-badge';
                } else if (isSectionDone(sid)) {
                    status.textContent = '✓ Listo';
                    status.className = 'section-status done';
                    done++;
                } else {
                    status.textContent = 'Pendiente';
                    status.className = 'section-status pending';
                }
            });
            const pct = Math.round((done / 2) * 100);
            const fill = document.getElementById('progress-fill');
            const label = document.getElementById('progress-label');
            if (fill) fill.style.width = pct + '%';
            if (label) label.textContent = done + ' / 2 secciones';
        }

        document.getElementById('anexo2-form')?.addEventListener('input', updateProgress);
        document.getElementById('anexo2-form')?.addEventListener('change', updateProgress);
        document.querySelectorAll('.section-header').forEach(h => {
            h.addEventListener('click', () => setTimeout(updateProgress, 50));
        });

        updateProgress();
    </script>
@endpush