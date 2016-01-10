<?php
include('functions.php');

session_start();
if (empty($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

?>

<?php include "header.php" ?> 
        <?php
            $mysql = dbConnect();
            $stmt = $mysql->prepare("SELECT RASA.ID, RASA.NAZWA "
                    . "FROM RASA");
            $stmt->bind_result($id, $nazwa);
            if (!$stmt) {
                die();
            }
            $stmt->execute();
        ?>
        <H1>Nowy pies:</H1><br>
        <div class="form-style">
            <form action="wstawianie_nowego_psa.php" method="POST">                  
                <label for="name"><span>Imię:</span><input type="text" name="name"></label>                
                <label for="mother"><span>Matka:</span><input type="text" name="mother"></label> 
                <label for="father"><span>Ojciec:</span><input type="text" name="father"></label>
                <label for="breed"><span>Rasa:</span>
                        <select name="breed"> 
                        <?php while ($stmt->fetch()) {
                            echo "<option value=\"$id\">$nazwa</option>";
                        } 
                        $stmt->close(); ?>
                    </select>
                </label>
                <label for="gender"><span>Płeć:</span>
                    <select name="gender">                       
                        <option value="0">Pies</option>
                        <option value="1">Suka</option>                       
                    </select>
                </label>                      
                <label><span>&nbsp;</span><input type="submit" value="Dodaj"></label>                                   
            </form>
        </div>
<?php include "footer.php" ?> 
