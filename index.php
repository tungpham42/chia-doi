<!DOCTYPE html>
<html lang="vi">

<?php
// Turn off error for indexing array's key
// P.S. for myself: Don't use it again if u r unsure which error will pop next
error_reporting(0);
ini_set('display_errors', 'Off');
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/materia/bootstrap.min.css" integrity="sha384-B4morbeopVCSpzeC1c4nyV0d0cqvlSAfyXVfrPJa25im5p+yEN/YmhlgQP/OyMZD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Ứng dụng chia đội</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Ứng dụng chia đội</a>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <div class="col-auto my-3">
                    <label for="numOfGroup" class="col-form-label">Số đội: </label>
                </div>
                <div class="col-auto mb-3">
                    <input type="number" class="form-control input-lg" name="numOfGroup" id="numOfGroup" placeholder="Số đội" min="2" max="12" value="<?php echo isset($_POST["numOfGroup"]) ? $_POST["numOfGroup"] : '2'; ?>">
                </div>
                <div class="col-auto mb-3">
                    <label for="nameList" class="col-form-label">Danh sách thành viên: </label>
                </div>
                <div class="col-auto mb-3">
                    <textarea name="nameList" class="form-control input-lg" id="nameList" cols="30" rows="10"><?php echo isset($_POST["nameList"]) ? $_POST["nameList"] : ''; ?></textarea>
                </div>
                <input class="ml-3 btn btn-primary" type="submit" name="submitForm" value="Chia đội">
            </form>
        </div>
    </div>
</body>

<?php
if (isset($_POST["submitForm"])) {
    $k = 1; //preventing division by 0 exception
    $k = (int) $_POST["numOfGroup"];
    $nameList = explode("\n", $_POST['nameList']);
    $n = count($nameList);
    shuffle($nameList); //shuffling array of names
    $divRes = $n / $k;
    $modRes = $n % $k;
    echo '<div class="container"><div class="row bg-light text-dark h4 p-5 text-monospace">';
    if ($modRes == 0) {
        for ($i = 0; $i < $k; $i++) { //iteration for each group
            $slicedList = array_slice($nameList, 0, $divRes); //extract the array
            echo "Đội số " . $i + 1 . ": ";
            for ($j = 0; $j < $divRes; $j++) { //iteration for each team's members
                echo $slicedList[$j] . "   ";
            }
            array_splice($nameList, 0, $divRes); //remove the extracted array
            echo "<br>";
        }
    } else if ($modRes != 0) {
        $mainArray = array(); //declare a bigger scope array
        for ($i = 0; $i < $k; $i++) {
            $slicedList = array_slice($nameList, 0, $divRes);
            $mainArray[$i] = $slicedList; //store current sliced list to main array
            array_splice($nameList, 0, $divRes); //remove the extracted array
        }
        for ($i = 0; $i < $modRes; $i++) {
            $remainderItem = array_slice($nameList, 0, 1);
            array_push($mainArray[$i], $remainderItem[0]);
            array_splice($nameList, 0, 1);
        }
        for ($i = 0; $i < $k; $i++) {
            echo "Đội số " . $i + 1 . ": ";
            for ($j = 0; $j < $divRes; $j++) { //iteration for each team's members
                echo $mainArray[$i][$j] . "   ";
            }
            echo "<br>";
        }
    }
    echo '</div></div>';
}
?>
    <footer class="mt-auto text-white-50 bg-dark p-3">
        <div class="container">
            <div class="row">
                <p>&copy; Bản quyền <a href="https://tungpham42.github.io/" class="text-white">Phạm Tùng</a></p>
            </div>
        </div>
    </footer>
</html>