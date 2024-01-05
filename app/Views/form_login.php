<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="cricket">
  <title>latihan-ci4</title>
  <style>.help-block { color: red; }</style>
</head>
<body>
  <?=form_open('login');?>
  <p>
    <input type="text" name="email" placeholder="email" autocomplete="off">
    <?=validation_show_error('email');?>
  </p>
  <p>
    <input type="password" name="password" placeholder="password" autocomplete="off">
    <?=validation_show_error('password');?>
  </p>
  <p><button type="submit">login</button></p>
  <?=form_close();?>

  <div class="help-block">
    <?=session()->getFlashdata('error');?>
  </div>
</body>
</html>
