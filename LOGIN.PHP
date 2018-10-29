<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"shop");
#$i=$_REQUEST['itemno'];


if($_REQUEST['submit2'])
{
$id=$_REQUEST['email'];
$pass=$_REQUEST['password'];
   $sel=mysqli_query($con,"select email,pass from register where   email='$id'");
  $arr=mysqli_fetch_array($sel);
if(($arr['email']==$id) and( $arr['pass']==$pass))
  {
  session_start();
   $_SESSION['eid']=$id;

echo "<script>location.href='home.html?itemno=$i'</script>";
   }
else
{
$er="id and password do not match";
echo $er;
}
}
?>
