@extends('Layouts.admin')

@section('contenido')
<div id="contenedor">
    <div class="mt-3 titulo"> Proveedores que más han donado</div>


    <div class="mt-3" id="adminChart"></div>


    <div  class="titulo"> Riders que más han entregado </div>


    <div class="mt-3" id="adminChart2"></div>


</div>








 @endsection


 <style>

    #adminChart, #adminchart2,#adminChart3 {
        width: 500px;
        height: 435px;
        border-radius:22px;
        padding: 2%;
    }

    .titulo{
        color : white!important;
        margin : 20px;
    }

    #contenedor{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;




    }


    #adminChart2{
        background: linear-gradient(to right, #8e8e8e99 0%, #5c5c5ca1 51%, #acacac9c 100%)
    }

    #adminChart{
        background: linear-gradient(to right, #8e8e8e99 0%, #5c5c5ca1 51%, #acacac9c 100%)
    }
 </style>
