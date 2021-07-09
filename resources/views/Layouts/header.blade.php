<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fullstack Dev Test</title>

        <!-- Boostrap4 css and js external links -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

        <!-- Styles -->
     <style> 
  
#list-title {
    margin-bottom: 5%;
    margin-top:5%;
text-align: center;
}
.container{
    margin-top: 15%;
}
form{
    margin-top:7%;
    background-color: #F5F5F5;
    width: 30%;
    height: 70%;
    border-radius: 10px;
    margin-left: auto;
    margin-right: auto;
}
.col-auto.my-1{

    width: 180px;
}
.form-row{
    
    padding: 10%;
}
#div-alert{
    width: 40%;
    margin-right: auto;
    margin-left: auto;
}

#btn-submit, .form-text.text-muted {
    
    padding-left: 40%;
    padding-bottom: 5%;
}
@media (max-width:750px) {
    
    form{
        width: 100%;
        
    }
    #div-alert{
        width: 100%;
    }
}
    </style>
      
    </head>
    <nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('home') }}">AptPay</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="{{ route('home') }}">Disbursements  </a>
      <a class="nav-item nav-link" href="{{ route('create') }}">Make disbursement </a>
    
    </div>
  </div>
</nav>
