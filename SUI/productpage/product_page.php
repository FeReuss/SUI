<?php
  require __DIR__ . '/funciones.php';
  if (isset($_GET['int'])) {} 
  else {
     if (isset($_GET['barr'])) {
      $barra = $_GET['barr'];
      $int = findint($barra);
      header("Location: \SUI\productpage\product_page.php?int=$int");
     }
     else { header('Location: '.$uri.'..\index.html');}
    };
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SUI</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="comosevenoma.css">
</head>
<body style="margin: 0px">
  <div class="header" style="width: 100vw; text-align: center; background-color: #369443">
    <h1 style="font-size:10vh; margin-top: 0px; color: rgb(255, 255, 255)" onclick="location.href='../index.html'">SUI</h1>
  </div>
  <div style="text-align: center">
    <table class="CenterTable" style="background-color: #369443; color: #ffffff;">
      <tr>
        <th class="Column">Código interno del producto:</th>
        <td class="Column, InternalCode">
          <?php
            if (isset($_GET['int'])) {
              $int = $_GET['int'];
              echo $int;
            } 
            else {
                if (isset($_GET['barr'])) {
                  $barra = $_GET['barr'];
                  $int = findint($barra);
                }
                else {echo 'No se encontró el codigo interno del producto :(';}
              };
          ?>
        </td>
      </tr>
    </table>
    <table class="CenterTable" style="background-color: #369443; color: #ffffff;">
      <tr>
        <th class="Column">Código de barras del producto:</th>
        <td class="Column">
          <?php
          if (isset($_GET['int'])) {
            $int = $_GET['int'];
            $barra = findbarcode($int);
            echo $barra;
          } 
          else {
             if (isset($_GET['barr'])) {
               $barra = $_GET['barr'];
               echo $barra;
             }
             else {echo 'No se encontró el codigo de barras :(';}
            };
          ?>
        </td>
      </tr>
    </table>
    <table class="CenterTable" style="background-color: #369443; color: #ffffff;">
      <tr>
        <th class="Column">Descriptor del producto:</th>
        <td class="Column">
          <?php
            if (isset($_GET['int'])) {
              $int = $_GET['int'];
              $descriptor = finddescriptor($int);
              echo $descriptor;
            } 
            else {
              if (isset($_GET['barr'])) {
                $barra = $_GET['barr'];
                $int = findint($barra);
                $desc = finddescriptor($int);
                echo $desc;
              }
              else {echo 'No se encontró el dewscriptor del producto :(';}
              };
          ?>
        </td>
      </tr>
    </table>
  </div>
  <h3 style="margin:1vw">Lista de ubicaciones</h3>
  <div style="max-width: 95vw; text-align: center; display: flex; justify-content: space-around; flex-wrap: wrap">
    <?php
      if (isset($_GET['barr'])) {
        $barra = $_GET['barr'];
        $int = findint($barra);
        $ubicaciones = ubications($int);
        echo $ubicaciones;
      } else{
        $int = $_GET['int'];
        $ubicaciones = ubications($int);
        echo $ubicaciones;
      }
    ?>
  </div>
  <footer style="width: 100vw; position: fixed; bottom: 0%; display: flex; justify-content: space-between">
    <button style="border: none; padding: 0; background: none; color: #ffffff; margin-left: 1vh"><img src="left_arrow.png" alt="Volver atras" style="max-height:7vh" onclick="location.href='../index.html'"></button>
    <div>
      <button id='but_anadir' style='display:none; border: none; padding: 0; background: none; color: #ffffff'><img src="addlocation.png" alt="Editar" style="max-height: 7vh"></button>
      <button id='but_eliminar' style='display:none; border: none; padding: 0; background: none; color: #ffffff'><img src="trash.png" alt="Editar" style="max-height: 7vh"></button>
      <button id='but_editar' style="display: inline; border: none; padding: 0; background: none; color: #ffffff; margin-right: 1vh"><img src="edit.png" alt="Editar" style="max-height: 7vh"></button>
      <script type="text/javascript">
        document.getElementById('but_editar').onclick = function(){
          var x = document.getElementById("but_eliminar");
          if (x.style.display === "none") {
            x.style.display = "inline";
          } else {
            x.style.display = "none";
          }
          var x = document.getElementById("but_anadir");
          if (x.style.display === "none") {
            x.style.display = "inline";
          } else {
            x.style.display = "none";
          }
          var els = document.getElementsByClassName("checkubi");
          for(var i = 0; i < els.length; i++){
            var atributo = els[i].getAttribute('disabled');
            if (atributo == null){
              const att = document.createAttribute('disabled');
              att.value = true
              els[i].setAttributeNode(att);
            } else {
              els[i].disabled = false;
            }
          }
        }
      </script>
      <script type="text/javascript">
        var arr = []
        document.getElementById("but_eliminar").onclick = function(){
          var els = document.getElementsByClassName("checkubi");
          for(var i = 0; i < els.length; i++){
            if (els[i].checked == true){
              var elemento = els[i].id;
              arr.push(elemento);
            }           
          }
          var arrstring = arr.join('_')
          var int = "<?php echo $_GET['int'] ?>";
          var url = '/SUI/productpage/peticiones.php?int='+int+'&delete='+arrstring;
          window.location = url
        }
      </script>
      <script type="text/javascript">
        var arr = []
        document.getElementById("but_anadir").onclick = function(){
          var string = prompt("Ingresa una ubicacion o multiples ubicaciones separadas por '.'")
          var els = string.split('.')
          var arr = []
          for(var i = 0; i < els.length; i++){
            if (els[i].checked != ''){
              var elemento = els[i];
              arr.push(elemento);
            }           
          }
          var arrstring = arr.join('_')
          var int = "<?php echo $_GET['int'] ?>";
          var url = '/SUI/productpage/peticiones.php?int='+int+'&add='+arrstring;
          window.location = url
        }
      </script>
    </div>

  </footer>
</body>
</html> 