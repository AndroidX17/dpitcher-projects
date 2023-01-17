<?php 
if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>

<?php 



if (isset($_SESSION["useruid"])) {

    if ($_SESSION["useruid"] === "admin") {
    print_r($builds,true);
    } else {


        header("location: ../index.php");
exit();
    }


} else {


    header("location: ../index.php");
exit();


}


require_once 'functions.inc.php';



?>


  
    <?php else: ?>
    <?php foreach ($builds as $build): ?>
    <blockquote style="display: table; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">
      <p style="display: table-cell; width: 90%; vertical-align: top;">



      <?php 
      
echo " BUILD #";
  
$currentid = $build['id'];
$currentname = $build['name'];
$currentlink = $build['link'];
$currentnotes = $build['notes'];
$currenttested = $build['tested'];

$testedstrng = "tested";

if ($currenttested === "0") {
    $testedstrng = "untested";
}

echo htmlspecialchars($currentid, ENT_QUOTES, 'UTF-8');
echo " - ";

echo htmlspecialchars($currentname, ENT_QUOTES, 'UTF-8');
echo " - ";

echo htmlspecialchars($currentlink, ENT_QUOTES, 'UTF-8');
echo " ";
echo "<BR>";
echo "<BR>";
echo " notes: ";
echo htmlspecialchars($currentnotes, ENT_QUOTES, 'UTF-8');
echo " ";

echo " tested: ";
echo htmlspecialchars($testedstrng, ENT_QUOTES, 'UTF-8');
echo " ";

    


      ?>


<form style="display: table-cell; width: 3%;" action="/playtest-includes/deletethisbuild.inc.php" method="post">
    <input type="hidden" name="deleteid" value="<?php if ($_SESSION["useruid"] === "admin") { echo $currentid; } ?>">
    <input type="submit" class="bugga4" value="Delete" onclick="return confirm('Do you want to submit? Yes/No')">
    
  </form>






      </p>
    </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>








    <?php 

//<input type="text" name="name" placeholder="full name...."><BR>
//<input type="text" name="email" placeholder="email...."><BR>


if (isset($_GET["error"])) {

    if ($_GET["error"] == "scenario1") {


        echo "<p>scenario 1 happen</p>";
    } else if ($_GET["error"] == "scenario2") {

       echo "<p>scenario 2 happen</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    } else if ($_GET["error"] == "scenario3") {

        echo "<p>passwords dont match!</p>";
    } else if ($_GET["error"] == "stmtfailed") {

        echo "<p>Something went wrong! Try Again</p>";
    } else if ($_GET["error"] == "k4") {

        echo "<p>you have triggered k4!</p>";
    } else if ($_GET["error"] == "none") {

        echo "<p>there was a toggle</p>";
    }

}
?>

<H1>ADD BUILD </H1>

<form style="display: table-cell; width: 10%;" action="/playtest-includes/addthisbuild.inc.php" method="post">
    <input type="text" name="buildname" placeholder="buildname" value="">
    <input type="text" name="buildlink" placeholder="buildlink" value="">
    <input type="text" name="buildnotes" placeholder="buildnotes" value="">
    <input type="hidden" name="tested" placeholder="tested" value="0">
    <input type="submit" class="bugga3" value="add item">
  </form>
<BR><BR>





    
    <?php echo $output2; ?>