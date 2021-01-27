<?php 

session_start();

$_SESSION['post-data'] = $_POST;

// print_r($_SESSION['post-data']);

// echo '<strong>' . $_SESSION['post-data']['polName'] . '</strong>';
// $_SESSION['polName'] = $_POST['polName'];

// echo '<strong>' . $_SESSION['polName'] . '</strong>';
?>


<html>
<head>
    <style>
        table, th {
            border: 1px solid black;
            text-align: left;
        }

        td {
            border: 1px solid black;
            padding-left: 10px;
            text-align: right;
        }
    </style>
    <link rel="icon" href="img/horizonlogo.png" type="image/png" sizes="16x16">
</head>
<body>
<table>
    <tr>
        <th>Praktijkopleider</th>
        <td><?php echo $_SESSION['post-data']['polName'] . " " . $_SESSION['post-data']['polLastName'];?></td>
    </tr>
    <tr>
        <th>Student</th>
        <td><?php echo $_SESSION['post-data']['stuName'] . " - " . $_SESSION['post-data']['stuNr'];?></td>
    </tr>
    <tr>
        <th>Heeft student voldaan aan aantal uren?</th>
        <td>
            <?php 
                if($_SESSION['post-data']['hours'] == 'on'){
                    echo "Ja";
                } else {
                    echo "Nee";
                }
            ?>
        </td> 
    </tr>
    <tr>
        <th>Algemene werknemersvaardigheden</th>
        <td>
            <?php
                echo $_SESSION['post-data']['persOnt'] . "<br />" . 
                     $_SESSION['post-data']['intComm'] . "<br />" . 
                     $_SESSION['post-data']['extComm'] . "<br />" . 
                     $_SESSION['post-data']['samen'] . "<br />" . 
                     $_SESSION['post-data']['bedCult'] . "<br />" . 
                     $_SESSION['post-data']['initiatief'] . "<br />" . 
                     $_SESSION['post-data']['afspr'] . "<br />" . 
                     $_SESSION['post-data']['werkdruk'] . "<br />";
            ?>
    </tr>
    <!-- B1-K1-W1 -->
    <tr>
        <th>B1-K1-W1</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['K1W1-1'] . "<br />" . 
                     $_SESSION['post-data']['K1W1-2'] . "<br />" . 
                     $_SESSION['post-data']['K1W1-3'] . "<br />" . 
                     $_SESSION['post-data']['K1W1-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- B1-K1-W2 -->
    <tr>
        <th>B1-K1-W2</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['K1W2-1'] . "<br />" . 
                     $_SESSION['post-data']['K1W2-2'] . "<br />" . 
                     $_SESSION['post-data']['K1W2-3'] . "<br />" . 
                     $_SESSION['post-data']['K1W2-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- B1-K1-W3 -->
    <tr>
        <th>B1-K1-W3</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['K1W3-1'] . "<br />" . 
                     $_SESSION['post-data']['K1W3-2'] . "<br />" . 
                     $_SESSION['post-data']['K1W3-3'] . "<br />" . 
                     $_SESSION['post-data']['K1W3-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- B1-K1-W4 -->
    <tr>
        <th>B1-K1-W4</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['K1W4-1'] . "<br />" . 
                     $_SESSION['post-data']['K1W4-2'] . "<br />" . 
                     $_SESSION['post-data']['K1W4-3'] . "<br />" . 
                     $_SESSION['post-data']['K1W4-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- B1-K2-W1 -->
    <tr>
        <th>B1-K2-W1</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['K2W1-1'] . "<br />" . 
                     $_SESSION['post-data']['K2W1-2'] . "<br />" . 
                     $_SESSION['post-data']['K2W1-3'] . "<br />" . 
                     $_SESSION['post-data']['K2W1-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- B1-K2-W2 -->
    <tr>
        <th>B1-K2-W2</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['K2W2-1'] . "<br />" . 
                     $_SESSION['post-data']['K2W2-2'] . "<br />" . 
                     $_SESSION['post-data']['K2W2-3'] . "<br />" . 
                     $_SESSION['post-data']['K2W2-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- B1-K3-W1 -->
    <tr>
        <th>B1-K3-W1</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['K3W1-1'] . "<br />" . 
                     $_SESSION['post-data']['K3W1-2'] . "<br />" . 
                     $_SESSION['post-data']['K3W1-3'] . "<br />" . 
                     $_SESSION['post-data']['K3W1-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- B1-K3-W2 -->
    <tr>
        <th>B1-K3-W2</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['K3W2-1'] . "<br />" . 
                     $_SESSION['post-data']['K3W2-2'] . "<br />" . 
                     $_SESSION['post-data']['K3W2-3'] . "<br />" . 
                     $_SESSION['post-data']['K3W2-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- B1-K3-W3 -->
    <tr>
        <th>B1-K3-W3</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['K3W3-1'] . "<br />" . 
                     $_SESSION['post-data']['K3W3-2'] . "<br />" . 
                     $_SESSION['post-data']['K3W3-3'] . "<br />" . 
                     $_SESSION['post-data']['K3W3-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- P1-K1-W1 -->
    <tr>
        <th>P1-K1-W1</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['P1W1-1'] . "<br />" . 
                     $_SESSION['post-data']['P1W1-2'] . "<br />" . 
                     $_SESSION['post-data']['P1W1-3'] . "<br />" . 
                     $_SESSION['post-data']['P1W1-4'] . "<br />";
            ?> 
        </td>
    </tr>
    <!-- P1-K1-W2 -->
    <tr>
        <th>P1-K1-W2</th>
        <td>
            <?php 

                echo $_SESSION['post-data']['P1W2-1'] . "<br />" . 
                     $_SESSION['post-data']['P1W2-2'] . "<br />" . 
                     $_SESSION['post-data']['P1W2-3'] . "<br />" . 
                     $_SESSION['post-data']['P1W2-4'] . "<br />";
            ?> 
        </td>
    </tr>
</table>

</body>
</html>