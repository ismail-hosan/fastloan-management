<?php include_once('inc/header.php'); ?>
<form>
<ul id="information">
<li><label>Email:</label>
<input type="text" name="email"/></li>
<li><label>Full Name</label>
<input type="text" name="fullName"/></li>
<li>
<label>Sex</label>
<input type="radio" name="sex" value="Male"
checked="checked"/>Male
<input type="radio" name="sex" value="Female"/>Female
</li>
<li>
<label>Country</label>
<select name="country">
<option value="India">India</option>
<option value="UK">UK</option>
<option value="US">USA</option>
</select>
</li>
<li>
<input type="button" value="GO" name="submit"/>
</li>
</ul>
<p id="response" style="display: none;"></p>
</form>
</body>
</html>
<?php include_once('inc/footer.php'); ?>