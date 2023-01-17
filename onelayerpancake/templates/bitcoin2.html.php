<CENTER>
  <DIV class='modulomo'>
<form action="" method="post">
  <label for="cryptowallet" class="prettytext"><b>btc wallet scan</b></label><BR>
  <input type="hidden" name="postoffset" value="<?php echo $lastoffset; ?>" id="postoffset">
  <input type="hidden" name="lasthash" value="" id="lasthashhidden">
  <input type="hidden" name="currentpage" value="1" id="currentpage">
  <input type="hidden" name="usehash" value="<?php echo $givemore; ?>" id="usehash">
  <input type="hidden" name="previoushash" value="" id="previoushash">


  <?php

if ($cancluster === true) {



echo '<input type="hidden" name="CANCLUSTER" value="1" id="CANCLUSTER">';



}

//CREATE INDEX wallet_address_index ON mytable (wallet_address);
//SHOW INDEXES FROM mytable;

//ALTER TABLE mytable RENAME INDEX wallet_address_index TO address_index;

?>


  <textarea resize="none" id="cryptowallet" class="txtarae" name="cryptowallet" rows="3" cols="53" placeholder="1EzwoHtiXB4iFwedPr49iywjZn2nnekhoj"><?php echo $exampleaddress ?></textarea><BR>
  <DIV style='max-width:250px'>
  <CENTER><input class='bugga2' type="submit" name="submitto" id="submitter" value="Analyze"></CENTER>

</DIV>
</form>
</DIV>
</CENTER>