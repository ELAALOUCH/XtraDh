<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./bootstrap.min.css">
    <title>Document</title>
    <style>

.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table  tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table  tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table  tr:last-of-type {
    border-bottom: 2px solid #009879;
}


    </style>
</head>
<body>

    {{$paiement}}
    {{$message}}
      <div class="container">
        <table class="styled-table">
            <tr>          
              <th scope="col">Nom Prenom </th>
              <th scope="col">{{$paiement->enseignant->Nom}} {{$paiement->enseignant->prenom}}</th>
            </tr>
        </table>
        <h5>Interventions</h5>
        <table class="styled-table" border="1">
            <tr>
                <th>Intitulé intervention</th>
                <th>Nbr Heurs</th>
            </tr>
            @foreach ($intervention as $item)
            <tr>          
                <th scope="col">{{$item->Intitule_Intervention}}</th>
                <th>{{$item->Nbr_heures}}</th>
              </tr>
            @endforeach  
        </table>
        <table class="styled-table" border="1">
            <tr>          
              <th scope="col">Volume Horraire </th>
              <th scope="col">{{$paiement->VH}} </th>
            </tr>
        </table>
      </div>
    
    
    
</body>
</html>