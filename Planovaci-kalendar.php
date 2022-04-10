<?php
session_start();

if(!isset($_SESSION['userId'])) { 
    header('Location: ./index.php?error=no_login');
    exit;
}

require('dbh.php'); 

// Check connection
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $sql = "SELECT * FROM event;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $json=[];
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($json,$row);
        }
    }



    if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
        $jmeno = $_POST['name'];
        $datum = $_POST['date'];
        $cas = $_POST['time1'];
        $cas1 = $_POST['time2'];
        $trida = $_POST['trida'];
        $ucitel = $_POST['ucitel'];
        $garant = $_POST['garant'];
        $cena = $_POST['price'];
        $sraz = $_POST['place1'];
        $konani = $_POST['place2'];
        $typ = $_POST['typ'];

        $sql = "INSERT INTO event (Jmeno, Datum, Cas, Cas1, Trida, Ucitel, Garant, Cena, Sraz, Konani, Typ)
        VALUES ('$jmeno', '$datum', '$cas', '$cas1', '$trida', '$ucitel', '$garant', '$cena', '$sraz', '$konani', '$typ')";

        if ($conn->query($sql)) { 
            echo "<script type='text/javascript'>alert('Přidáno!');</script>";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Kalendář</title>
    <meta name='viewport' content='width=650'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
</head>
<header>
<form action="logout.php" method="post">
        <button class="tlacitko3" type="submit" name="logout-submit">Logout</button>
</form>
</header>

<body>
    <h1 class="nadpis">Plánovací kalendář pro výchovné poradenství</h1>

<div id="modal-pridat" class="modal">

  <!-- Modal content -->
  <form  action="" method="post">
  <div class="modal-content2">
    <div class="modal-header">
      <h3>Třída</h3>
      <input placeholder="V3B" id="trida" type="text" name="trida" style="margin-left:1rem ; display: flex;
       align-items: center;align-items: center;
       align-self:center;justify-content: center;height: 2rem;background-color: #fff;border: none;width: 10%; border-radius: 2px;">
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
            <div class="tabulka-eventů">
                <div class="moznosti">
                    <input placeholder="Název" type="text" name="name">
                    <input id="ucitel" placeholder="Typ akce: Učitel/Třída/Žák" type="text" name="typ">
                    <input placeholder="Garant" type="text" name="garant">
                    <input id="nocolor" placeholder="DayMonthYear" type="date" name="date">
                    <input placeholder="Od" type="time" name="time1">
                    <input placeholder="Do" type="time" name="time2" >
                    <input placeholder="Místo konání" type="text" name="place1">
                    <input placeholder="Místo srazu" type="text" name="place2">
                    <input placeholder="Doprovod" type="text" name="ucitel" id="ucitel">
                    <input placeholder="Cena" type="number" name="price">
                    <input class="pridat" type="submit" value="Přidat">
                </form>
                    
                </div>
                
            </div> 
    </div>
    <div class="modal-footer">
      <h3></h3>
    </div>
  </div>

</div>
    <div class="platno">
        
        <div class="container">
            
            <div class="calen">

                <h3 class="calen-header" id="monthAndYear"></h3>
                <table class="tab" id="calendar">

                    <thead>
                        <tr>
                            <th>Ne</th>
                            <th>Po</th>
                            <th>Út</th>
                            <th>St</th>
                            <th>Čt</th>
                            <th>Pá</th>
                            <th>So</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body">

                    </tbody>

                </table>
                <div class="form-inline">

                    <button class="tamazpet" id="previous" onclick="previous()">Předchozí</button>

                    <button class="tam" id="next" onclick="next()">Další</button>
                </div>
                <br/>
                <form class="form-inline">
                    <label class="lead mr-2 ml-2" for="month">Výběr měsíce a roku: </label>
                    <select class="mesic" name="month" id="month" onchange="jump()">
                    <option value=0>Leden</option>
                    <option value=1>Únor</option>
                    <option value=2>Březen</option>
                    <option value=3>Duben</option>
                    <option value=4>Květen</option>
                    <option value=5>Červen</option>
                    <option value=6>Červenec</option>
                    <option value=7>Srpen</option>
                    <option value=8>Září</option>
                    <option value=9>Říjen</option>
                    <option value=10>Listopad</option>
                    <option value=11>Prosinec</option>
                </select>
                    <label for="year"></label>
                    <select class="rok" name="year" id="year" onchange="jump()">
                    <option value=1990>1990</option>
                    <option value=1991>1991</option>
                    <option value=1992>1992</option>
                    <option value=1993>1993</option>
                    <option value=1994>1994</option>
                    <option value=1995>1995</option>
                    <option value=1996>1996</option>
                    <option value=1997>1997</option>
                    <option value=1998>1998</option>
                    <option value=1999>1999</option>
                    <option value=2000>2000</option>
                    <option value=2001>2001</option>
                    <option value=2002>2002</option>
                    <option value=2003>2003</option>
                    <option value=2004>2004</option>
                    <option value=2005>2005</option>
                    <option value=2006>2006</option>
                    <option value=2007>2007</option>
                    <option value=2008>2008</option>
                    <option value=2009>2009</option>
                    <option value=2010>2010</option>
                    <option value=2011>2011</option>
                    <option value=2012>2012</option>
                    <option value=2013>2013</option>
                    <option value=2014>2014</option>
                    <option value=2015>2015</option>
                    <option value=2016>2016</option>
                    <option value=2017>2017</option>
                    <option value=2018>2018</option>
                    <option value=2019>2019</option>
                    <option value=2020>2020</option>
                    <option value=2021>2021</option>
                    <option value=2022>2022</option>
                    <option value=2023>2023</option>
                    <option value=2024>2024</option>
                    <option value=2025>2025</option>
                    <option value=2026>2026</option>
                    <option value=2027>2027</option>
                    <option value=2028>2028</option>
                    <option value=2029>2029</option>
                    <option value=2030>2030</option>
                </select></form>
            </div>
        </div>
    </div>
    <div class="container">
            <h3>Přidat událost</h3>
            <button class="tlacitko" id="myBtn"><span class="material-icons">add_circle</span></button>
    </div>

    <div id="kalendar_data" style="display:none;">
        <?php
        foreach($json as $zaznam) {
            echo '<div class="zaznam_datum_' . $zaznam['datum'] . '">' . json_encode($zaznam, JSON_PRETTY_PRINT) . '</div>';
        }
        ?>
    </div>
    <script src="Kalendar.js"></script
</body>

</html>