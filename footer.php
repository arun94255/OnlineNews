    </div>
<div id="column">
      <div class="holder">
          <h2><marquee behavior="alternate"><img src="images/news1.gif"></img></marquee></h2>
        <?php
$whr = " where status = 'approved' and type = 'breaking' ";
 $r = run_sql("select * from news $whr order by id desc limit 3 ");
 while($row = mysql_fetch_array($r)){
  $title = put_elipses($row["sub"], 25);   
  $news = put_elipses($row["news"], 90);   
  echo "<ul id='latestnews'>
          <li><img class='imgl' style='width:80px;height:80px;' src='upload/$row[id].jpg' alt='' />
            <p><strong>$title</strong></p>
            <p>$news</p>
            <p class='readmore'><a href='news_det.php?id=$row[id]'>Continue Reading &raquo;</a></p>
          </li>
        </ul>";
 }  
        ?>
        
      </div>
    </div>    
<br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col6">
  <div id="footer">
      <div class="footbox">
          <h2>Other Links</h2>
      <ul>
        <li><a href="https://news.google.co.in/">Google News</a></li>
        <li><a href="http://www.rediff.com/news">Rediff News</a></li>
        <li class="last"><a href="https://in.news.yahoo.com/">Yahoo</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col7">
  <div id="copyright">
    <br class="clear" />
  </div>
</div>
</body>
</html>