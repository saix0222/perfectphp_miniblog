<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;" charset=utf-8" />
    <title><?php if (isset($title)): echo $this->escape($title) .' - ';
        endif; ?>MiniBlog</title>
</head>
<body>
    <div id="header">
        <h1><a href="<?php echo $base_url; ?>/">Mini Blog</a></h1>
    </div>

    <div id="main">
        <?php echo $_content; ?>
    </div>

</body>
</html>