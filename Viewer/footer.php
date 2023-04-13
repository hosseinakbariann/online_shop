       </div>
        <div class="sidebar">
            <ul>
                <li>
                	<h4>در کالاها جستجو کن</h4>
                    <ul>
                    	<li>
                            <form method="post" class="searchform" action="search.php" >
                                <p>
                                    <input type="text" size="20" value="" name="search" />
                                    <input type="submit" class="searchsubmit formbutton" value="بگرد" />
                                </p>
                            </form>	
						</li>
					</ul>
                </li>
                
                <li>
                    <h4>درباره ما</h4>
                    <ul>
                        <li>
                        	<p style="margin: 0;"><?php echo $infosite->about_minimal; ?></p>
                        </li>
                    </ul>
                </li>
                
                <li>
                	<h4>ورود</h4>
                    <ul>
                    	<li>
                            <form method="post" class="loginform" action="enter.php" >
                                <p>
									<label for="user">کاربر:</label>
                                    <input type="text" size="15" value="" name="user" />
                                </p>
                                <p>
									<label for="pass">رمز:&nbsp;&nbsp;</label>
                                    <input type="password" size="15" value="" name="pass" />
                                    <input type="submit" class="formbutton" value="ورود" />
                                </p>
                            </form>	
						</li>
					</ul>
                </li>
				
               <li>
                    <h4><span>گروه کالاها</span></h4>
                    <ul class="blocklist">
<?php
	$res = db_get_categories();
	$cat = new Category();
	while($row = db_fetch_row($res))
	{
		$cat->fill($row);
		echo "<li><a href='category.php?id=$cat->id'>$cat->title</a></li>";
		echo ENDLINE;
	}
?>
                    </ul>
                </li>                
            </ul> 
        </div>
    	<div class="clear"></div>
    </div>
</div>
<div id="footer">
    <div class="footer-content">
    	<div class="footer-width">
            <span class="sitename"><?php echo $infosite->title; ?></span>
                <p class="footer-links">
                <a href="index.php">صفحه اصلی</a> |
                <a href="register.php">ثبت نام</a> |
                <a href="guid.php">راهنما</a> |
                <a href="faq.php">پرسش و پاسخ های متداول</a> |
                <a href="about.php">درباره ما</a>
            </p>
         </div>
    </div>
    <div class="footer-width footer-bottom">
        <p><?php echo $infosite->copyright; ?></p>
     </div>
</div>
</body>
</html>
<?php db_close(); ?>
