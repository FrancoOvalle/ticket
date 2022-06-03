<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="process.php" method="POST">
                
                <div class="form-group">
                      <label for="inlineFormInputGroup">Email</label>
                      <div class="input-group ">
                        <div class="input-group-prepend">
                          <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="email" placeholder="Ingrese Email">
                      </div>
                    </div>
                  <div class="form-group">
                    <label for="inputNombre">Nombre:</label>
                    <input type="text" class="form-control" id="inputNombre" name="name" placeholder="Ingrese Nombre">
                  </div>
                  <div class="form-group">
                    <label for="inputTelefono">Telefono:</label>
                    <input type="text" class="form-control" id="inputTelefono" name="telefono" placeholder="+56 9 8765 4321">
                  </div>
                  <div class="form-row">
                  <label for="exampleFormControlTextarea1">Contenido</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="contenido" rows="3"></textarea>
                  </div>
                  <br>
                  <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
                </form>
</body>
</html>