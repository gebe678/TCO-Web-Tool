<?php 

    $inactive = 7200;
    ini_set("session.gc_maxlifetime", $inactive);

    session_start();

    if(!isset($_SESSION["userid"]) || $_SESSION["userid"] != true)
    {
        header("Location: index.php");
        exit;
    }

//     if(isset($_SESSION["testing"]) and (time() - $_SESSION["testing"] > $inactive))
//     {
//         session_unset();
//         session_destroy();

//         header("Location: index.php");
//         exit;
//     }

//     $_SESSION["testing"] = time();
// ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom tags here -->
    <meta name="author" content="Griffin Lehrer">
    <meta name="description" content="calculate thhe total cost of operation for a vehicle">

    <!-- Custom CSS link tags go here -->

    <!-- Custom javascript link tags go here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-piechart-outlabels"></script>
    <script src="assets/javascript/tabControl.js" defer></script>
    <script src="assets/javascript/sliderControl.js" defer> </script>
    <script src="assets/javascript/dropDownControl.js" defer> </script>
    <script src="assets/javascript/vehicleGraph.js" defer></script>
    <script src="assets/javascript/usedVehicleControl.js" defer></script>
    <script src="assets/javascript/hiddenInputControl.js" defer></script>
    <!-- <script src="assets/javascript/createDatabaseEntries.js" defer></script> -->
    <!-- <script src="assets/javascript/imageOverlay.js" defer></script> -->
    <script src="assets/javascript/formControl.js" defer></script>

    <title>TCO Web Tool</title>
  </head>
  <body>
    
    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                

            </div><!-- </col-lg-12> -->

        </div> <!-- </row> -->

    </div> <!--</container>-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>