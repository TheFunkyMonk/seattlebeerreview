<h2>Final Score:
<?php
  include( get_stylesheet_directory() . '/get-score.php');
  echo $totalScore / 10 ?> -
  <?php if ( $totalScore >= 90 ) { ?>
    Outstanding</h2>World-class example of style.
  <?php } elseif ( $totalScore >= 76 ) { ?>
    Excellent</h2>Exemplifies style well, requires minor fine-tuning.
  <?php } elseif ( $totalScore >= 60 ) { ?>
    Very Good</h2>Generally within style parameters, some minor flaws.
  <?php } elseif ( $totalScore >= 42 ) { ?>
    Good</h2>Misses the mark on style and/or minor flaws.
  <?php } elseif ( $totalScore >= 28 ) { ?>
    Fair</h2>Off flavors/aromas or major style deficiencies. Unpleasant.
  <?php } else { ?>
    Problematic</h2>Major off flavors and aromas dominate. Hard to drink.
  <?php } ?>
