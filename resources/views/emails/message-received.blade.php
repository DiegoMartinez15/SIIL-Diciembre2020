<!DOCTYPE html>
<html>
<head >
    <link rel="stylesheet" type="text/css" href="public\css\email.css">
<title>Mensaje Recibido</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col col-md-6 col-md-offset-3"   >
              <div class="card">
                  <div class="panel-heading"><h3 class="panel-title">Sistema Informatico de Intermedacion Laboral</h3></div>
                    <h3><strong>Recibistes un mensaje de:</strong></h3>
                    <p>{{ $msg['names'] }}&nbsp;{{ $msg['lastNames']}} - {{$msg['email']}}</p>
                  </div>
                <div class="panel panel-default">
                    
                  <div class="panel-body">
                    <h3><strong>Asunto:</strong></h3>
                    <p>{{ $msg['content'] }}</p>
                  </div>
                  <div class="panel-footer">
                      
                  </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
