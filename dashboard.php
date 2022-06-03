<?php 
    $title ="Dashboard - "; 
    include "head.php";
    include "sidebar.php";
//separar si es usuario administrador o no 
if($_SESSION['tipo_us']==2){
    $user=$_SESSION['user_id'];
    $isWhere="AND user_id=$user";
   }else{
       $isWhere="";
   }
  
    $TicketData=mysqli_query($con, "select * from ticket where status_id=1 $isWhere");
    $ProjectData=mysqli_query($con, "select * from project");
    $CategoryData=mysqli_query($con, "select * from category");
    $UserData=mysqli_query($con, "select * from user order by created_at desc");
?>
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="row top_tiles">
                    <a href="tickets.php"><div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-ticket"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($TicketData) ?></div>
                          <h3>Tickets Pendientes</h3>
                        </div>
                    </div></a>
                    
                    <a href="projects.php"><div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-list-alt"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($ProjectData) ?></div>
                          <h3>Delegación</h3>
                        </div>
                    </div></a>
                    <a href="categories.php"><div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-th-list"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($CategoryData) ?></div>
                          <h3>Unidades</h3>
                        </div>
                    </div></a>
                    <a href="users.php"><div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-users"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($UserData) ?></div>
                          <h3>Usuarios</h3>
                        </div>
                    </div></a>
                </div>
                <!-- content -->
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                    <div id="canvas-holder" >
        <canvas id="chart-area" ></canvas>
            <div>

                
            </div>
    </div>
   <?php 
   

   $sql = mysqli_query($con, "SELECT COUNT(id) as name FROM `ticket` where status_id=1 $isWhere ORDER BY `num_ticket` ASC");
   if($c=mysqli_fetch_array($sql)) {
       $pend=$c['name'];
   }
   
   $sql = mysqli_query($con, "SELECT COUNT(id) as name FROM `ticket` where status_id=2 $isWhere ORDER BY `num_ticket` ASC");
    if($c=mysqli_fetch_array($sql)) {
     $desarr=$c['name'];
    }

    $sql = mysqli_query($con, "SELECT COUNT(id) as name FROM `ticket` where status_id=3 $isWhere ORDER BY `num_ticket` ASC");
    if($c=mysqli_fetch_array($sql)) {
     $termina=$c['name'];
    }

    $sql = mysqli_query($con, "SELECT COUNT(id) as name FROM `ticket` where status_id=4 $isWhere ORDER BY `num_ticket` ASC");
    if($c=mysqli_fetch_array($sql)) {
     $cancel=$c['name'];
    }
    
   ?>
    
    <script>

const actions = [
  {
    name: 'Position: top',
    handler(chart) {
      chart.options.plugins.legend.position = 'top';
      chart.update();
    }
  },
  {
    name: 'Position: right',
    handler(chart) {
      chart.options.plugins.legend.position = 'right';
      chart.update();
    }
  },
  {
    name: 'Position: bottom',
    handler(chart) {
      chart.options.plugins.legend.position = 'bottom';
      chart.update();
    }
  },
  {
    name: 'Position: left',
    handler(chart) {
      chart.options.plugins.legend.position = 'left';
      chart.update();
    }
  },
];
      const DATA_COUNT = 4;
    const NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 100};

    //datos
    <?php 
    echo" var pend = '$pend';";
    echo" var endes = '$desarr';";
    echo" var termin = '$termina';";
    echo" var cancel = '$cancel';";
    ?>
    

const data = {
  labels: ['Pendientes', 'En Desarrollo', 'Terminados', 'Cancelados'],
  datasets: [{
      label: 'Reportes',
      data: [pend, endes , termin , cancel],
      backgroundColor: ["rgb(195, 1, 1)","rgb(255, 165, 0)","rgb(1, 183, 46)","rgb(166, 166, 166)"],
    }]
};



    var config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Reportes'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };




    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myDoughnut = new Chart(ctx, config);
    };

    </script>
                    </div> 
                    <div class="col-md-8 col-xs-12 col-sm-12">
                        <?php include "lib/alerts.php";
                            profile(); //llamada a la funcion de alertas
                        ?>    
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Informacion personal</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                            <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/upd_profile.php" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="name" id="first-name" class="form-control col-md-7 col-xs-12" value="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Correo electronico 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="last-name" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $email; ?>">
                                        </div>
                                    </div>

                                    <br><br><br>
                                    <h2 style="padding-left: 50px">Cambiar Contraseña</h2>
                            
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña antigua
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="birthday" name="password" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="**********">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nueva contraseña 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="birthday" name="new_password" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar contraseña nueva
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input id="birthday" name="confirm_new_password" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" name="token" class="btn btn-success">Actualizar Datos</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>
<script>
    $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "action/upload-profile.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
    });
</script>