<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

        * {
            box-sizing: border-box;
            padding: 0px;
            margin: 0px; }

        body, html {
            font-family: "Verdana",sans-serif;
            font-size: 12px;
            background: #FFFFFF;
            line-height: 1.5;
        }

        .header {
            display: flex;
            background: #fff;
            padding: 15px 20px;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05); }
        .header .logo {
            font-size: 32px;
            font-weight: bold;
            color: #0034BB; }
        .header .search {
            position: relative; }
        .header .search .icon {
            position: absolute;
            top: 5px;
            left: 5px; }
        .header .search .icon img {
            width: 24px;
            height: 24px;
            object-fit: cover; }
        .header .search .form-control {
            padding: 8px 10px;
            border-radius: 8px;
            font-size: 1rem;
            width: 100%;
            background: rgba(0, 52, 187, 0.06);
            border: 1px solid transparent;
            color: #2B2B2B;
            padding-left: 40px;
            outline: 0px; }
        .header .search .form-control:focus {
            background: #fff;
            border-color: #0034BB; }
        .header .search .form-control::placeholder {
            color: rgba(0, 52, 187, 0.5); }

        .main-content {
            padding: 0px 20px; }

        .invoice-container {
            max-width: 1500px;
            margin: auto;
            padding: 3rem;
            background: #fff; }
        .invoice-container .top {
            margin-bottom: 4rem;
            display: flex;
            justify-content: space-between; }
        .invoice-container .top .top-left {
            color: #0034BB; }
        .invoice-container .top .main {
            font-size: 30px;
            text-transform: uppercase;
            font-weight: 500;
            display: block;
            margin-bottom: 0.5rem; }
        .invoice-container .top .code {
            font-size: 24px; }
        .invoice-container .top .date {
            font-size: 18px;
            color: #ADADAD;
            margin-bottom: 10px; }

        .bill-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4rem;
            color: #ADADAD; }
        .bill-box .left, .bill-box .right {
            max-width: 240px; }
        .bill-box .text-m {
            font-size: 18px;
            margin-bottom: 1rem;
            text-transform: uppercase; }
        .bill-box .title {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 500;
            color: #2B2B2B; }
        .bill-box .title_mini {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
            color: #3d3d3d; }

        .table-bill table {
            width: 100%;
            border-collapse: 0px;
            border-spacing: 0px;
            font-size: 1rem; }

        .table-bill th, .table-bill td {
            text-align: left;
            padding: 10px 10px;
            font-weight: 500; }

        .table-bill td {
            padding: 15px 10px; }

        .table-bill th {
            text-transform: uppercase;
            color: #0034BB;
            font-weight: 500; }

        .table-bill .quantity {
            width: 100px; }

        .table-bill .cost {
            text-align: right;
            white-space: nowrap; }

        .table-bill .total {
            font-size: 24px;
            color: #0034BB; }
        .table-bill .total td {
            font-weight: normal;
            border-top: 1px solid #ececec; }
        .table-bill .total .number {
            text-align: right;
            font-weight: 600; }

        .actions {
            text-align: center;
            margin-top: 4rem; }
        .actions .btn {
            margin: 3px;
            padding: 8px 10px;
            font-size: 1rem;
            text-transform: uppercase;
            font-weight: bold;
            border: 0px;
            min-width: 130px;
            color: #0034BB;
            border-radius: 8px;
            background: rgba(0, 52, 187, 0.06);
            cursor: pointer; }
        .actions .btn:hover {
            background: rgba(0, 52, 187, 0.1); }

        .note {
            text-align: center;
            margin-top: 1rem;
            font-size: 12px;
            color: #ADADAD; }

        @media (max-width: 1320px) {
            body, html {
                font-size: 14px; }
            .invoice-container .top .date {
                font-size: 14px; }
            .invoice-container .top .main {
                font-size: 32px; }
            .invoice-container .top .code {
                font-size: 18px; }
            .bill-box .text-m {
                font-size: 14px; }
            .bill-box .title {
                font-size: 1.5rem; }
            .table-bill .total {
                font-size: 16px; } }

        @media (max-width: 768px) {
            .invoice-container .top {
                display: block; }
            .invoice-container .top .top-left {
                margin-bottom: 1rem; }
            .bill-box {
                display: block; }
            .bill-box .left, .bill-box .right {
                max-width: 100%; }
            .table-bill table, .table-bill tbody, .table-bill tfoot, .table-bill td, .table-bill th, .table-bill tr {
                display: block; }
            .table-bill th {
                display: none; }
            .table-bill tbody tr {
                padding: 10px 0px;
                border-bottom: 1px solid #e5e5e5; }
            .table-bill tbody tr td:first-child {
                display: none; }
            .table-bill td {
                padding: 5px 0px; }
            .table-bill .cost {
                text-align: left; }
            .table-bill .total {
                margin-top: 20px; }
            .table-bill .total td {
                border-top: 0px; }
            .table-bill .total .number {
                text-align: left; } }

        @media (max-width: 420px) {
            .actions .btn {
                width: 100%;
                margin: 5px 0px; }
            .header {
                display: block; } }



    </style>
</head>
<body style="margin-top: 25px;">
<div class="main-content">
    <div class="invoice-container">

        <div class="top">
            <div class="top-left">
                <h1 class="main">Université Abdelmalek ESSAADI</h1>
                <span class="code">Fiche de Paie</span>
            </div>
            <div class="top-right">
                <div class="date"><?php
                                  $currentDateTime = date('Y-m-d H:i:s');
                                  echo $currentDateTime;
                                  ?></div>
            </div>
        </div>

        <div class="bill-box">

            <div class="text-m" style="color: #101010">À :</div>
            <div class="title">{{$paiement->enseignant->Nom}} {{$paiement->enseignant->prenom}}</div>
            <div style="font-size: 15px">
                <i>Statut : </i>{{$grade->designation}}<br>
                <i>Établissement d'origine : </i>{{$paiement->etablissement->Nom}}<br>
                <i>Année universitaire : </i> {{$paiement->Annee_univ}}</div>
        </div>


        <div class="table-bill">
            <table class="table-service">
                <thead style="font-size: 13px;" >
                <th>id</th>
                <th>Etablissement</th>
                <th>Volume Horaire</th>
                <th>Salaire Brut</th>
                <th>Salaire Net</th>
                </thead>
                <tbody>
                @foreach ($intervention as $item)
                    <tr style="font-size: 13px; color: #101010"class="total">
                        <td>{{$item->etablissement->id}}</td>
                        <td>{{$item->etablissement->Nom}}</td>
                        <td>{{$paiement->VH}}</td>
                        <td>MAD {{ ($paiement->Taux_H * $paiement->VH) }}</td>
                        <td class="cost">MAD {{($paiement->Taux_H * $paiement->VH)*(1-$paiement->IR)}}</td>
                    </tr>
                @endforeach
                </tbody>
@php
    $somme_heures=0;
    $net = ($paiement->Taux_H * $paiement->VH)*(1-$paiement->IR);
    $somme_net = 0;
   foreach($intervention as $item){
       $somme_heures+=$paiement->VH;
        $somme_net += $net;
   }
   if($somme_heures>200){
       $somme_net = 200 * $paiement->Taux_H *(1-$paiement->IR);
   }
@endphp

                <tfoot>
                <tr class="total" style="font-size:14px;">
                    <td colspan="3" class="name ">Volume horaire</td>
                    <td colspan="3" class="number">@php echo $somme_heures ;@endphp Heures</td>
                </tr>

                @php
                 if($somme_heures>200){
                 @endphp

                <tr class="total" style="font-size:14px;color: #d31811;">
                    <td colspan="4" class="name ">Plafond horaire maximal</td>
                    <td colspan="4" class="number">200 h</td>
                </tr>

                @php
                    }
                @endphp

                <tr class="total" style="font-size:14px;">
                    <td  colspan=4" class="name ">Total</td>
                    <td colspan="4" class="number">MAD @php echo $somme_net ;@endphp</td>
                </tr>
                </tfoot>

            </table>
        </div>


        <br>
        <br>
        <br>
        <div class="text-m" style="font-size: 20px">Détails des interventions</div>
        <br>


        <div class="table-bill">
            <table class="table-service">
                <thead style="font-size: 11px;" >
                <th>id</th>
                <th>Intervention</th>
                <th>Etablissement</th>
                <th>Semestre</th>
                <th>Début</th>
                <th class="cost">Fin</th>
                </thead>
                <tbody>
                @foreach ($intervention as $item)
                    <tr style="font-size: 11px; color: #101010"class="total">
                        <td>{{$item->id_intervention}}</td>
                        <td>{{$item->Intitule_Intervention}}</td>
                        <td>{{$item->etablissement->Nom}}</td>
                        <td>{{$item->Semestre}}</td>
                        <td>{{$item->Date_debut}}</td>
                        <td>{{$item->Date_fin}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>



        <div class="note">
            <p>Le service XtraDH vous souhaite une bonne journée!</p>
            <p>www.uae.ac.ma</p>
        </div>
    </div>
</div>






</body>
</html>



