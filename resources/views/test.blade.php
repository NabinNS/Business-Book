<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
<style>


    .Modalform{
        width: 300px;
        height: 50px;
        position: relative;
    }
    .Modalform input{
        width: 100%;
        height: 100%;
        background: transparent;
        border: 2px solid #2ecc71;
        border-radius: 10px;
        outline: none;
        padding: 0 10px;
        font-size: 20px;
    }
    .Modalform label{
        position: absolute;
        top: 10px;
        left: 15px;
        color: black;
        text-transform: capitalize;
        font-size: 18px;
        transition: top .3s;
        padding: 0 5px;
    }
    .Modalform input:focus ~label{
        top: -10px;
        background-color: white;
    }

</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>


</head>
<body >
    <div class="Modalform mt-4">
        <input type="text">
        <label for="">search</label> 
    </div>     
    <div class="Modalform mt-4">
        <input type="text">
        <label for="">search</label>
        
    </div>    

</body>
</html>

