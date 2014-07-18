
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title><?=$config['title']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="/static/components/bootstrap/dist/css/bootstrap.min.css">
    <link href="/static/css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h3 class="text-muted"><?=$config['title']?></h3>
    </div>

    <h4><?=$collection['title']?></h4>

    <div class="text-center">
        <img src="/static/img/check.png" alt="" width="100px" /><br /><br />
        <strong>Your card was processed successfully.</strong><br />
        (<?=$charge->id?>)
    </div>
  </body>
</html>
