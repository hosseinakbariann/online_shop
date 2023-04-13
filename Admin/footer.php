        </div>
        <div class="sidebar">
            <ul>
                <li>
					<p><span class="bold"><?php echo get_fullname(); ?></span> محترم خوش آمدید</p>
                </li>
				
               <li>
                    <h4><span>ثبت جدید</span></h4>
                    <ul class="blocklist">
                        <li><a href="newcategory.php">گروه کالا</a></li>
                        <li><a href="newgoods.php">کالا</a></li>
                    </ul>
                </li>    
				
                <li>
                	<h4>سابقه کاربر</h4>
                    <ul>
                    	<li>
                            <form method="post" class="searchform" action="usershistory.php" >
								<p><label for="username">&nbsp;&nbsp;&nbsp;</label>
									<select name="username">
<?php
	$res = db_get_users_no_admin();
	$u = new User();
	while($row = db_fetch_row($res))
	{
		$u->fill($row);
		echo "<option value='$u->username'>$u->name</option>";
		echo ENDLINE;
	}
?>
									</select>
								</p>
                                <p>
                                    <input type="submit" class="searchsubmit formbutton" value="نمایش بده"/>
                                </p>
                            </form>	
						</li>
					</ul>
                </li>
				
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
                <a href="invoceactive.php">فاکتورهای فعال</a> |
                <a href="guid.php">راهنما</a> |
                <a href="faq.php">پرسش و پاسخ های متداول</a> |
                <a href="about.php">درباره ما</a> |
                <a href="info.php">اطلاعات سایت</a> |
                <a href="changepass.php">تغییر کلمه عبور</a> |
                <a href="../exit.php">خروج</a>
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
