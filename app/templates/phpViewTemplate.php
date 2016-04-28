<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Insert title here</title>
</head>
<body>
<?php
class PhpViewTemplate extends \Slim\View
{
 	public function render($template)
    {
        // $template === 'show.php'
        print_r($this->data);
    }
} 
?>
<p>Yes html</p>
</body>
</html>