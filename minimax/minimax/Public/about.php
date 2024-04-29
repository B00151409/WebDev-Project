<?php
session_start();
include "../templates/header.php";

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About League of Ireland</title>

</head>
<body>

<div id="home" style="background-image: url('https://d33kuhj6eu7i5b.cloudfront.net/thumbnails/xxl/9116/9989/3254/bg-green.png'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-6 col-md-6 col-sm-offset-6 col-sm-6">
                <div class="container">



                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br><br><br><br>
<div class="container">
    <h1>About the League of Ireland</h1>
    The League of Ireland is the highest level of football in the Republic of Ireland, comprising of two divisions: the Premier Division and the First Division. Established in 1921, the league has a rich history and has played a crucial role in the development of football in Ireland.
    <br>
    <br>
    <h2>Premier Division:</h2>
    <p>
        The Premier Division consists of the top 10 football clubs in Ireland, competing for the title each season. With its fast-paced, competitive matches, the Premier Division showcases some of the best football talent in the country.

    </p>
    <br>
    <h2>First Division:</h2>
    <p>
        The First Division serves as the second tier of professional football in Ireland. Comprising of 10 clubs, it provides an exciting platform for emerging talent and aspiring footballers to showcase their skills.

    </p>
    <br>
    <p>From nail-biting matches to unforgettable moments, the League of Ireland continues to captivate football fans across the nation. Join us as we celebrate the beautiful game and support our clubs in their pursuit of glory.
    </p>
<br>





    <div class="container">
        <h1>About the League of Ireland</h1>
        <br>
        <h2>Premier Division Standings</h2>
        <br>
        <table style="border-collapse: collapse;">
            <tr style="color: white; font-size: 16px; border: 1px solid black;">
                <th style="padding-right: 30px; border: 1px solid black;">Position</th>
                <th style="padding-right: 30px; border: 1px solid black;">Team</th>
                <th style="padding-right: 30px; border: 1px solid black;">Played</th>
                <th style="border: 1px solid black;">Points</th>
            </tr>
            <?php
            $teams = array(
                array("Shelbourne", 12, 22),
                array("Shamrock Rovers", 11, 19),
                array("Derry City", 12, 19),
                array("Bohemians", 11, 19),
                array("Galway United FC", 11, 15),
                array("St Patrick's Athletic", 12, 15),
                array("Sligo Rovers", 11, 14),
                array("Waterford", 11, 13),
                array("Drogheda United", 10, 8),
                array("Dundalk", 11, 5)
            );

            foreach ($teams as $key => $team) {
                echo "<tr style='color: black; font-size: 16px; border: 1px solid black;'>";
                echo "<td style='padding-right: 30px; border: 1px solid black;'>" . ($key + 1) . "</td>";
                echo "<td style='padding-right: 30px; border: 1px solid black;'>" . $team[0] . "</td>";
                echo "<td style='padding-right: 30px; border: 1px solid black;'>" . $team[1] . "</td>";
                echo "<td style='border: 1px solid black;'>" . $team[2] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
    </div>
    <?php

    $first_image = "../images/League_Of_Ireland_logo_2023.jpg";
    ?>



    <div class="image-section">
        <img src="<?php echo $first_image; ?>" alt="First Division Image">
    </div>

</div>
<?php include "../templates/footer.php"; ?>

</body>
</html>
