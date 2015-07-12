<?php
  $appearance_rating = get_field('appearance_rating');
  $aroma_rating = get_field('aroma_rating');
  $flavor_rating = get_field('flavor_rating');
  $mouthfeel_rating = get_field('mouthfeel_rating');
  $overall_rating = get_field('overall_rating');
  $totalScore = (($appearance_rating + $aroma_rating + $flavor_rating + $mouthfeel_rating + $overall_rating) * 2);
?>
