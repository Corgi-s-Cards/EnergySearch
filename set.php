<?php
require_once 'include.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php include "header.php" ?>

<body>
    <?php include "navbar.php" ?>
    <div class="container-wide">
        <div class="panel panel-full">
            <div style="text-align: center;">
                <?php if (isset($_GET['ID'])) {
                    if (set_exists(sanitizeInput($_GET['ID']))) {

                        global $pdo;
                        // Retrieve the set
                        $id = sanitizeInput($_GET['ID']);
                        $stmt = $pdo->prepare("SELECT * FROM es_card_sets WHERE id = ?");
                        $stmt->execute([$id]);
                        $set = $stmt->fetch(PDO::FETCH_ASSOC);

                        echo '<table>';
                        echo '<tr>';
                        echo '<th><img width="30" height="30" src=' . $set['symbol_url'] . '>' . $set['name'] . '</th>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td valign="top">';
                        echo '<span id="Set">';

                        ?>

                        <b>Series:</b>
                        <?php echo $set['series']; ?>
                        <br>

                        <b>Printed Total:</b>
                        <?php echo $set['printed_total']; ?>
                        <br>

                        <b>Total:</b>
                        <?php echo $set['total']; ?>
                        <br>

                        <b>Unlimited:</b>
                        <?php echo $set['unlimited_legality']; ?>
                        <br>

                        <b>Standard:</b>
                        <?php echo $set['standard_legality']; ?>
                        <br>

                        <b>Expanded:</b>
                        <?php echo $set['expanded_legality']; ?>
                        <br>

                        <b>PTCGL Code:</b>
                        <?php echo strtoupper($set['ptcgo_code']); ?>
                        <br>

                        <b>Release Date:</b>
                        <?php echo $set['release_date']; ?>
                        <br>

                        <b>Updated At:</b>
                        <?php echo $set['updated_at']; ?>
                        <br>


                        <?php

                        echo '</span>';
                        echo "</td>";
                        echo '</tr>';
                        echo '</table>';

                        $stmt = $pdo->prepare("SELECT * FROM es_cards WHERE set_id = ? ORDER BY CAST(REGEXP_REPLACE(set_number, '[^0-9]', '') AS UNSIGNED) ASC");
                        $stmt->execute([$id]);

                        $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($cards as $card) {
                            echo "<a href='card.php" . "?ID=" . $card['id'] . "'>" . '<img width="250" height="350" src=' . $card['small_image'] . "" . " alt=" . '"' . $card['name'] . '"' . ">" . "</a>";

                        }


                    } else {
                        echo "Set does not exist!";
                    }
                } else {
                    echo "No set specified!";
                }
                ?>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>

</html>