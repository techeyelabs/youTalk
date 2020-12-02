<style>
    .buttons{
        border: 1px solid #64b7f9;
        border-radius: 4px;
        background-color: #64b7f9;
        width: 190px;
        padding: 5px;
        box-shadow: 1px 1px #7f9098;
    }
    .mytabs{
        /* width: 33%; */
        text-align: center;
        /* border: 1px solid gray; */
        padding: 20px;
    }
    .table_cells{
        width: 23%;
        text-align: center;
        border: 1px solid;
        padding: 9px;
    }
    .index_cells{
        width: 8%; 
        border: 1px solid; 
        text-align: center;
    }
    td {
        vertical-align: top;
        border-bottom: 1px solid #eaeaea;
        padding: 10px
    }
</style>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="col-md-12 row pt-5">
    <div class="col-md-2"></div>
    <div class="col-md-8 text-center" style="font-size: 16px">
        <div>残高: {{$personal->wallet_balance}} P</div>
        <div>&nbsp;</div>
    </div>
    <div class="col-md-2"></div>
</div>