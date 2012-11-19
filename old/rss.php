<?php header('Content-Type: application/rss+xml'); ?>
<?='<?'?>xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>Is It Christmas?</title>
    <link>http://isitchristmas.com</link>
    <language>en-us</language>
    <description>Is it Christmas?</description>
    <atom:link href="http://isitchristmas.com/rss.xml" rel="self" type="application/rss+xml" />    
    <?php
      $days = array();
      for ($i=0; $i<10; $i++)
        $days[] = strtotime("-$i days");
      
      // From 12/27 - 12/23, comment this out for performance
      require 'iic.php';
      
      // This is to give each link/guid a unique anchor
      // The anchor is the # of days since October 17, 2007, when I started the site
      function id($day) {
        return floor(($day - strtotime("10/17/07")) / (60 * 60 * 24));
      }
    ?>

<?php foreach ($days as $day) { ?>
<?php
  // From 12/27 - 12/23, switch the commenting for performance
  $answer = isItChristmas($day);
  // $answer = "NO";
?>
      <item>
        <title><?= $answer ?></title>
        <description><?= $answer ?></description>
        <link>http://isitchristmas.com#<?= id($day); ?></link>
        <guid>http://isitchristmas.com#<?= id($day); ?></guid>
        <pubDate><?= strftime("%a, %d %b %Y 00:00:00 -0700", $day); ?></pubDate>
      </item>
      
<?php } ?>
    
  </channel>
</rss>
