@extends('layouts.app')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap');

        :root {
            --gold:       #b8962e;
            --gold-light: #f0dcaa;
            --gold-pale:  #fdf8ee;
            --gold-deep:  #7a5c10;
            --ivory:      #faf8f3;
            --cream:      #f5f0e8;
            --warm-gray:  #8a8478;
            --ink:        #1c1a16;
            --ruby:       #7a2232;
            --emerald:    #0e5c3e;
            --sapphire:   #1a3a6b;
            --border:     rgba(184,150,46,0.18);
            --border-md:  rgba(184,150,46,0.32);
            --shadow-sm:  0 2px 12px rgba(184,150,46,0.08);
            --shadow-md:  0 6px 32px rgba(184,150,46,0.14);
        }

        * { box-sizing: border-box; }

        body {
            background: var(--ivory);
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
        }

        /* ── PAGE LAYOUT ──────────────────────────────────────── */
        .si-page {
            max-width: 1320px;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem;
        }

        /* ── HEADER ───────────────────────────────────────────── */
        .si-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.75rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border-md);
        }

        .si-header-left {}

        .si-eyebrow {
            font-size: 11px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .si-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.1;
            margin: 0;
        }

        .si-title em {
            font-style: italic;
            color: var(--gold-deep);
        }

        .si-pill-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--gold-pale);
            border: 1px solid var(--border-md);
            color: var(--gold-deep);
            font-size: 12px;
            font-weight: 500;
            padding: 5px 14px;
            border-radius: 40px;
            letter-spacing: 0.03em;
        }

        .si-pill-count .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold);
        }

        /* ── STATS ROW ─────────────────────────────────────────── */
        .si-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .si-stat {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 18px;
            position: relative;
            overflow: hidden;
        }

        .si-stat::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 3px; height: 100%;
            background: linear-gradient(180deg, var(--gold-light), var(--gold));
            border-radius: 3px 0 0 3px;
        }

        .si-stat-label {
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--warm-gray);
            margin-bottom: 6px;
        }

        .si-stat-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 26px;
            font-weight: 600;
            color: var(--ink);
            line-height: 1;
        }

        .si-stat-unit {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            color: var(--warm-gray);
            margin-left: 3px;
            font-weight: 400;
        }

        /* ── TOOLBAR ───────────────────────────────────────────── */
        .si-toolbar {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 1.25rem;
        }

        .si-search-wrap {
            position: relative;
            flex: 1;
            min-width: 200px;
            max-width: 280px;
        }

        .si-search-wrap svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            stroke: var(--warm-gray);
            pointer-events: none;
        }

        .si-search-wrap input {
            width: 100%;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--ink);
            background: #fff;
            border: 1px solid var(--border-md);
            border-radius: 8px;
            padding: 9px 12px 9px 36px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .si-search-wrap input::placeholder { color: #bbb5a8; }
        .si-search-wrap input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(184,150,46,0.12);
        }

        .si-select {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--ink);
            background: #fff;
            border: 1px solid var(--border-md);
            border-radius: 8px;
            padding: 9px 34px 9px 12px;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238a8478' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .si-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(184,150,46,0.12);
        }

        .si-add-btn {
            margin-left: auto;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, #d4af37 0%, #b8962e 60%, #9a7a20 100%);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            border: none;
            padding: 9px 20px;
            border-radius: 8px;
            cursor: pointer;
            letter-spacing: 0.03em;
            box-shadow: 0 4px 14px rgba(184,150,46,0.35);
            transition: box-shadow 0.25s, transform 0.2s;
            text-decoration: none;
        }

        .si-add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 22px rgba(184,150,46,0.48);
            color: #fff;
        }

        .si-add-btn svg {
            width: 15px; height: 15px;
            stroke: #fff;
        }

        /* ── TABLE CARD ────────────────────────────────────────── */
        .si-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .si-table-wrap {
            overflow-x: auto;
        }

        .si-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 960px;
            font-size: 13px;
        }

        /* HEAD */
        .si-table thead {
            background: var(--cream);
            border-bottom: 1px solid var(--border-md);
        }

        .si-table thead th {
            font-family: 'DM Sans', sans-serif;
            font-size: 10.5px;
            font-weight: 500;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: var(--warm-gray);
            padding: 13px 16px;
            white-space: nowrap;
            text-align: left;
        }

        .si-table thead th.r { text-align: right; }

        /* BODY */
        .si-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.14s;
        }

        .si-table tbody tr:last-child { border-bottom: none; }

        .si-table tbody tr:hover { background: var(--gold-pale); }

        .si-table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            color: var(--ink);
        }

        .si-table tbody td.r { text-align: right; }

        /* serial */
        .td-serial {
            font-size: 11px;
            color: #c4bfb4;
            font-weight: 400;
            width: 36px;
        }

        /* inward no badge */
        .inward-badge {
            display: inline-block;
            font-family: 'DM Mono', monospace;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 0.05em;
            background: var(--gold-pale);
            color: var(--gold-deep);
            border: 1px solid rgba(184,150,46,0.25);
            padding: 4px 10px;
            border-radius: 6px;
            white-space: nowrap;
        }

        /* thumbnail */
        .td-img {
            width: 56px;
        }

        .thumb {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            object-fit: cover;
            border: 1.5px solid var(--border-md);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            display: block;
        }

        .thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 18px rgba(184,150,46,0.28);
        }

        .no-img {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: var(--cream);
            border: 1px dashed var(--border-md);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
        }

        .no-img svg { width: 16px; height: 16px; stroke: #ccc5b5; }
        .no-img span { font-size: 9px; color: #ccc5b5; letter-spacing: 0.05em; text-transform: uppercase; }

        /* category name */
        .td-category {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
        }

        /* type badges */
        .type-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 5px;
            white-space: nowrap;
            letter-spacing: 0.02em;
        }

        .tb-mfg  { background: #e8f5ee; color: #0b5932; border: 1px solid rgba(11,89,50,0.12); }
        .tb-prod { background: #faeeda; color: var(--gold-deep); border: 1px solid rgba(184,150,46,0.18); }
        .tb-cat  { background: #f0eefa; color: #4a3fa0; border: 1px solid rgba(74,63,160,0.14); }

        /* purity */
        .purity-chip {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 20px;
            background: var(--cream);
            color: var(--gold-deep);
            border: 1px solid var(--border);
            letter-spacing: 0.04em;
        }

        /* weights */
        .wt-val {
            font-variant-numeric: tabular-nums;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
        }

        .wt-unit {
            font-size: 10.5px;
            color: var(--warm-gray);
            margin-left: 2px;
            font-weight: 400;
        }

        .wt-net {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--gold-deep);
        }

        /* empty state */
        .si-empty {
            display: none;
            text-align: center;
            padding: 4rem 2rem;
        }

        .si-empty svg { width: 48px; height: 48px; stroke: #d4c89a; margin-bottom: 1rem; }
        .si-empty p { font-size: 14px; color: var(--warm-gray); margin: 0; }

        /* ── MODAL ─────────────────────────────────────────────── */
        .si-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(28,26,22,0.6);
            backdrop-filter: blur(4px);
            z-index: 9900;
            align-items: center;
            justify-content: center;
        }

        .si-overlay.open { display: flex; }

        .si-modal {
            background: var(--ivory);
            border-radius: 18px;
            width: 700px;
            max-width: 94vw;
            box-shadow: 0 32px 80px rgba(28,26,22,0.32);
            overflow: hidden;
            animation: modalIn 0.22s ease;
            position: relative;
        }

        @keyframes modalIn {
            from { transform: scale(0.93) translateY(12px); opacity: 0; }
            to   { transform: scale(1) translateY(0); opacity: 1; }
        }

        /* gold top bar */
        .si-modal-bar {
            height: 4px;
            background: linear-gradient(90deg, #d4af37, #b8962e, #9a7a20, #b8962e, #d4af37);
        }

        .si-modal-body {
            display: flex;
            gap: 0;
        }

        /* image pane */
        .si-modal-img-pane {
            width: 260px;
            flex-shrink: 0;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
            border-right: 1px solid var(--border);
        }

        .si-modal-img-pane img {
            width: 100%;
            max-height: 280px;
            object-fit: contain;
            border-radius: 10px;
        }

        /* details pane */
        .si-modal-details {
            flex: 1;
            padding: 28px 28px 20px;
            display: flex;
            flex-direction: column;
        }

        .si-modal-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
            margin: 0 0 4px;
        }

        .si-modal-sub {
            font-size: 13px;
            color: var(--warm-gray);
            margin: 0 0 20px;
        }

        .si-modal-rows {
            flex: 1;
        }

        .si-modal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed var(--border);
        }

        .si-modal-row:last-child { border-bottom: none; }

        .si-modal-row .lbl {
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--warm-gray);
        }

        .si-modal-row .val {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
            text-align: right;
        }

        /* weight footer */
        .si-modal-weights {
            display: flex;
            justify-content: space-around;
            background: var(--cream);
            border-top: 1px solid var(--border);
            padding: 16px 24px;
            gap: 12px;
        }

        .si-wt-block {
            text-align: center;
            flex: 1;
            position: relative;
        }

        .si-wt-block + .si-wt-block::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; height: 60%;
            width: 1px;
            background: var(--border-md);
        }

        .si-wt-lbl {
            display: block;
            font-size: 10px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--warm-gray);
            margin-bottom: 5px;
        }

        .si-wt-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 600;
            color: var(--gold-deep);
            display: block;
        }

        .si-wt-unit {
            font-family: 'DM Sans', sans-serif;
            font-size: 11px;
            color: var(--warm-gray);
            font-weight: 400;
        }

        /* close button */
        .si-modal-close {
            position: absolute;
            top: 16px;
            right: 18px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--cream);
            border: 1px solid var(--border-md);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: background 0.15s;
        }

        .si-modal-close:hover { background: var(--gold-pale); }
        .si-modal-close svg { width: 14px; height: 14px; stroke: var(--warm-gray); }

        /* ── DIVIDER ORNAMENT ───────────────────────────────────── */
        .ornament-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
            opacity: 0.45;
        }

        .ornament-divider::before,
        .ornament-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .ornament-divider svg {
            width: 16px; height: 16px;
            fill: var(--gold);
            flex-shrink: 0;
        }

        /* ── RESPONSIVE ─────────────────────────────────────────── */
        @media (max-width: 640px) {
            .si-modal-body { flex-direction: column; }
            .si-modal-img-pane { width: 100%; border-right: none; border-bottom: 1px solid var(--border); padding: 20px; }
            .si-title { font-size: 24px; }
            .si-stats { grid-template-columns: repeat(2, 1fr); }
        }
    </style>

    <div class="si-page">

        {{-- ── HEADER ─────────────────────────────────────────── --}}
        <header class="si-header">
            <div class="si-header-left">
                <div class="si-eyebrow">Inventory Management</div>
                <h1 class="si-title">Stock <em>Inward</em> Register</h1>
            </div>
            <div class="si-pill-count" id="siCount">
                <span class="dot"></span>
                <span id="siCountNum">{{ $inwards->count() }}</span> items
            </div>
        </header>

        {{-- ── STATS ───────────────────────────────────────────── --}}
        @php
            $totalItems = $inwards->count();
            $totalGross = $inwards->sum('Gross_Weight');
            $totalNet = $inwards->sum('Net_Weight');
            $totalStone = $inwards->sum('Stone_Weight');
            $categories = $inwards->pluck('Category_Name')->unique()->count();
        @endphp

        <div class="si-stats">
            <div class="si-stat">
                <div class="si-stat-label">Total Items</div>
                <div class="si-stat-value">{{ $totalItems }}</div>
            </div>
            <div class="si-stat">
                <div class="si-stat-label">Gross Weight</div>
                <div class="si-stat-value">{{ number_format($totalGross, 2) }}<span class="si-stat-unit">g</span></div>
            </div>
            <div class="si-stat">
                <div class="si-stat-label">Stone Weight</div>
                <div class="si-stat-value">{{ number_format($totalStone, 2) }}<span class="si-stat-unit">g</span></div>
            </div>
            <div class="si-stat">
                <div class="si-stat-label">Net Weight</div>
                <div class="si-stat-value">{{ number_format($totalNet, 2) }}<span class="si-stat-unit">g</span></div>
            </div>
            <div class="si-stat">
                <div class="si-stat-label">Categories</div>
                <div class="si-stat-value">{{ $categories }}</div>
            </div>
        </div>

        {{-- ── ORNAMENT ────────────────────────────────────────── --}}
        <div class="ornament-divider">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2l2.09 6.26L20 10l-5 4.73L16.18 22 12 18.77 7.82 22 9 14.73 4 10l5.91-1.74z"/>
            </svg>
        </div>

        {{-- ── TOOLBAR ─────────────────────────────────────────── --}}
        <div class="si-toolbar">
            <div class="si-search-wrap">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                <input type="text" id="siSearch" placeholder="Search items, categories…" oninput="siFilter()">
            </div>

            <select class="si-select" id="siCatFilter" onchange="siFilter()">
                <option value="">All Categories</option>
                @foreach($inwards->pluck('Category_Name')->unique()->sort() as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>

            <select class="si-select" id="siMfgFilter" onchange="siFilter()">
                <option value="">All Manufacturing</option>
                @foreach($inwards->pluck('Manufacturing_Type')->unique()->sort() as $mfg)
                    <option value="{{ $mfg }}">{{ $mfg }}</option>
                @endforeach
            </select>

            <select class="si-select" id="siProdFilter" onchange="siFilter()">
                <option value="">All Product Types</option>
                @foreach($inwards->pluck('Product_Type')->unique()->sort() as $pt)
                    <option value="{{ $pt }}">{{ $pt }}</option>
                @endforeach
            </select>

            <a href="{{ route('stock.inward') }}" class="si-add-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Add Item
            </a>
        </div>

        {{-- ── TABLE ───────────────────────────────────────────── --}}
        <div class="si-card">
            <div class="si-table-wrap">
                <table class="si-table" id="siTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Inward No.</th>
                            <th>Design</th>
                            <th>Category</th>
                            <th>Cat. Type</th>
                            <th>Manufacturing</th>
                            <th>Product Type</th>
                            <th>Item</th>
                            <th>Purity</th>
                            <th class="r">Gross Wt.</th>
                            <th class="r">Stone Wt.</th>
                            <th class="r">Net Wt.</th>
                        </tr>
                    </thead>
                    <tbody id="siBody">
                        @forelse($inwards as $key => $row)
                            <tr
                                data-search="{{ strtolower($row->Item_Name . ' ' . $row->Category_Name . ' ' . $row->Inward_No . ' ' . $row->Category_Type . ' ' . $row->Purity) }}"
                                data-category="{{ $row->Category_Name }}"
                                data-mfg="{{ $row->Manufacturing_Type }}"
                                data-prod="{{ $row->Product_Type }}"
                            >
                                <td class="td-serial">{{ $key + 1 }}</td>

                                <td><span class="inward-badge">{{ $row->Inward_No }}</span></td>

                                <td class="td-img">
                                    @if($row->Jewellery_Image)
                                        <img
                                            src="{{ asset('uploads/' . $row->Jewellery_Image) }}"
                                            class="thumb si-preview"
                                            data-img="{{ asset('uploads/' . $row->Jewellery_Image) }}"
                                            data-item="{{ $row->Item_Name }}"
                                            data-category="{{ $row->Category_Name }}"
                                            data-cattype="{{ $row->Category_Type }}"
                                            data-mfg="{{ $row->Manufacturing_Type }}"
                                            data-prod="{{ $row->Product_Type }}"
                                            data-purity="{{ $row->Purity }}"
                                            data-inward="{{ $row->Inward_No }}"
                                            data-gross="{{ number_format($row->Gross_Weight, 3) }}"
                                            data-stone="{{ number_format($row->Stone_Weight, 3) }}"
                                            data-net="{{ number_format($row->Net_Weight, 3) }}"
                                            alt="{{ $row->Item_Name }}"
                                        >
                                    @else
                                        <div class="no-img">
                                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9l4-4 4 4 4-4 4 4"/>
                                                <path d="M3 15l4 4 4-4 4 4 4-4"/>
                                            </svg>
                                            <span>None</span>
                                        </div>
                                    @endif
                                </td>

                                <td class="td-category">{{ $row->Category_Name }}</td>

                                <td><span class="type-badge tb-cat">{{ $row->Category_Type }}</span></td>

                                <td><span class="type-badge tb-mfg si-mfg-badge">{{ $row->Manufacturing_Type }}</span></td>

                                <td><span class="type-badge tb-prod si-prod-badge">{{ $row->Product_Type }}</span></td>

                                <td style="font-weight:500;">{{ $row->Item_Name }}</td>

                                <td><span class="purity-chip">{{ $row->Purity }}</span></td>

                                <td class="r">
                                    <span class="wt-val">{{ number_format($row->Gross_Weight, 3) }}</span>
                                    <span class="wt-unit">g</span>
                                </td>

                                <td class="r">
                                    <span class="wt-val">{{ number_format($row->Stone_Weight, 3) }}</span>
                                    <span class="wt-unit">g</span>
                                </td>

                                <td class="r">
                                    <span class="wt-net">{{ number_format($row->Net_Weight, 3) }}</span>
                                    <span class="wt-unit">g</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">
                                    <div class="si-empty" style="display:block;">
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                                        </svg>
                                        <p>No stock inward records found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Empty filter state --}}
            <div class="si-empty" id="siEmpty">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                <p>No items match your filters.</p>
            </div>
        </div>

    </div>{{-- /si-page --}}


    {{-- ── IMAGE / DETAIL MODAL ────────────────────────────────────── --}}
    <div class="si-overlay" id="siOverlay">
        <div class="si-modal" id="siModal">
            <div class="si-modal-bar"></div>

            <button class="si-modal-close" id="siModalClose">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>

            <div class="si-modal-body">
                {{-- Image pane --}}
                <div class="si-modal-img-pane">
                    <img id="siModalImg" src="" alt="">
                </div>

                {{-- Details pane --}}
                <div class="si-modal-details">
                    <div class="si-modal-heading" id="siModalItem">—</div>
                    <div class="si-modal-sub" id="siModalInward">—</div>

                    <div class="si-modal-rows">
                        <div class="si-modal-row">
                            <span class="lbl">Category</span>
                            <span class="val" id="siModalCategory">—</span>
                        </div>
                        <div class="si-modal-row">
                            <span class="lbl">Category Type</span>
                            <span class="val" id="siModalCatType">—</span>
                        </div>
                        <div class="si-modal-row">
                            <span class="lbl">Manufacturing</span>
                            <span class="val" id="siModalMfg">—</span>
                        </div>
                        <div class="si-modal-row">
                            <span class="lbl">Product Type</span>
                            <span class="val" id="siModalProd">—</span>
                        </div>
                        <div class="si-modal-row">
                            <span class="lbl">Purity</span>
                            <span class="val" id="siModalPurity">—</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Weight footer --}}
            <div class="si-modal-weights">
                <div class="si-wt-block">
                    <span class="si-wt-lbl">Gross Weight</span>
                    <span class="si-wt-num" id="siModalGross">—</span>
                    <span class="si-wt-unit">grams</span>
                </div>
                <div class="si-wt-block">
                    <span class="si-wt-lbl">Stone Weight</span>
                    <span class="si-wt-num" id="siModalStone">—</span>
                    <span class="si-wt-unit">grams</span>
                </div>
                <div class="si-wt-block">
                    <span class="si-wt-lbl">Net Weight</span>
                    <span class="si-wt-num" id="siModalNet">—</span>
                    <span class="si-wt-unit">grams</span>
                </div>
            </div>
        </div>

    @push('scripts')
        <script>
        /* ── FILTER ─────────────────────────────────────────────────── */
        function siFilter() {
            const q    = document.getElementById('siSearch').value.toLowerCase().trim();
            const cat  = document.getElementById('siCatFilter').value;
            const mfg  = document.getElementById('siMfgFilter').value;
            const prod = document.getElementById('siProdFilter').value;

            const rows = document.querySelectorAll('#siBody tr');
            let visible = 0;

            rows.forEach(row => {
                const search   = (row.dataset.search   || '').toLowerCase();
                const rowCat   = row.dataset.category  || '';
                const rowMfg   = row.dataset.mfg       || '';
                const rowProd  = row.dataset.prod      || '';

                const show = (!q    || search.includes(q))
                          && (!cat  || rowCat  === cat)
                          && (!mfg  || rowMfg  === mfg)
                          && (!prod || rowProd === prod);

                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            document.getElementById('siCountNum').textContent = visible;
            document.getElementById('siEmpty').style.display  = visible === 0 ? 'block' : 'none';
        }

        /* ── MODAL ──────────────────────────────────────────────────── */
        document.addEventListener('click', function(e) {
            const img = e.target.closest('.si-preview');
            if (!img) return;

            document.getElementById('siModalImg').src         = img.dataset.img;
            document.getElementById('siModalItem').textContent    = img.dataset.item;
            document.getElementById('siModalInward').textContent  = 'Inward No. ' + img.dataset.inward;
            document.getElementById('siModalCategory').textContent = img.dataset.category;
            document.getElementById('siModalCatType').textContent  = img.dataset.cattype;
            document.getElementById('siModalMfg').textContent      = img.dataset.mfg;
            document.getElementById('siModalProd').textContent     = img.dataset.prod;
            document.getElementById('siModalPurity').textContent   = img.dataset.purity;
            document.getElementById('siModalGross').textContent    = img.dataset.gross;
            document.getElementById('siModalStone').textContent    = img.dataset.stone;
            document.getElementById('siModalNet').textContent      = img.dataset.net;

            document.getElementById('siOverlay').classList.add('open');
        });

        document.getElementById('siModalClose').addEventListener('click', function() {
            document.getElementById('siOverlay').classList.remove('open');
        });

        document.getElementById('siOverlay').addEventListener('click', function(e) {
            if (!e.target.closest('#siModal')) {
                this.classList.remove('open');
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('siOverlay').classList.remove('open');
            }
        });

        /* ── DYNAMIC BADGE COLORS (manufacturing) ───────────────────── */
        (function() {
            const palette = [
                ['#e3f2fd','#0d47a1'],
                ['#fce4ec','#880e4f'],
                ['#e8f5e9','#1b5e20'],
                ['#fff3e0','#e65100'],
                ['#ede7f6','#4527a0'],
                ['#e0f7fa','#006064'],
                ['#f3e5f5','#6a1b9a'],
                ['#fff8e1','#f57f17'],
            ];
            const map = {};
            let idx = 0;

            document.querySelectorAll('.si-mfg-badge').forEach(el => {
                const t = el.textContent.trim();
                if (!map[t]) { map[t] = palette[idx++ % palette.length]; }
                el.style.background = map[t][0];
                el.style.color       = map[t][1];
                el.style.borderColor = map[t][1] + '22';
            });

            const map2 = {};
            let idx2 = 2;
            document.querySelectorAll('.si-prod-badge').forEach(el => {
                const t = el.textContent.trim();
                if (!map2[t]) { map2[t] = palette[idx2++ % palette.length]; }
                el.style.background = map2[t][0];
                el.style.color       = map2[t][1];
                el.style.borderColor = map2[t][1] + '22';
            });
        })();
        </script>
    @endpush

@endsection