
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

    <table class="table table-striped">
        <?php foreach($collections as $id => $collection) { ?>
        <td>
            <td><?=$collection['title']?></td>
            <td><?=$collection['description']?></td>
            <td class="text-right"><a href="/collect/<?=$id?>">Go</a></td>
        </td>
        <?php } ?>
    </table>
  </body>
</html>
