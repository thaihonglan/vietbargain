<?php
use yii\helpers\Html;
use Yii;
use yii\base\Model;
use app\models\User;
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>

Chúc mừng bạn đã đăng ký thành công !

<p><? echo User::first_name . ' ' . User::last_name .','; ?> bạn hãy click vào link bên dưới để kích hoạt tài khoản :</p>

<?= $confirmLink ?>

