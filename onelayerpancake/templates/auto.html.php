<h2>AUTOPHILOSOPHER</h2>

<p>Welcome to AUTOMATIC PHILOSOPHIZING </p>


<section class="index-intro">

<?php

session_start();



?>

<?php
    if (isset($_SESSION["useruid"])) {
    echo "<p>logged in as " . $_SESSION["useruid"]. "</p>";


  //  echo " RANDOM STATEMENT";




        //$sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
        // adjusts any X with Y
        
        
        //$affectedRows = $pdo->exec($sql);
        
       
        //$output = 'Database connection established.  ' . 'Updated ' . $affectedRows .' rows.';
        $output = 'Database connection established.  ';
        echo $output;
        $sql2 = 'SELECT `id`,`concept` FROM `concepts`';
        
        // $sql2 = 'SELECT `concept` FROM `concepts`';
        
 
        $concepts = $pdo->query($sql2);
        //$result = $pdo->query($sql2);
   
        $output2 = '';
        
      //  echo "we know of the following";
        
        /*
        while ($row = $result->fetch()) {
            $names[] = $row['firstName'];
          }*/

          foreach ($concepts as $row) {
            $conceptz[] = $row['concept'];
          }
  
          echo '<script type="text/javascript">';
          
      //$newarray = array('abc', 'def', 'ghi');
      $js_array = json_encode($conceptz);
     echo "var javascript_array = ". $js_array . ";\n";
    //  echo "document.write(javascript_array);"    
        echo '</script>';


      //  foreach ($result as $row) {
        

       //   $newarray
          //  $concepts[] = array('id' => $row['id'], 'concept' =>
           // $row['concept']);
        
         //  $concepts[] = $result;
        
        
        //  }


        //$concepts = $result;
        
          ob_start();
          include 'showconcepts.html.php';
          $output2 = ob_get_clean();
        //  $output2 = include '/templates/formresults.html.php';
        /*
          foreach ($names as $name) {
            $output2 .= '<blockquote>';
            $output2 .= '<p>';
            $output2 .= $name;
            $output2 .= '</p>';
            $output2 .= '</blockquote>';
        }
        */
    





} else {

echo "please log in";
$error = "need log in";
}



?>



<SCRIPT language="javascript">
function checkvariables() {

if (javascript_array) {
  console.log(javascript_array);


alert(javascript_array);

}
}
    </SCRIPT>
<INPUT Type="BUtton" value="click me" onclick="checkvariables()" > </INPUT>


<?php

echo $output
?>