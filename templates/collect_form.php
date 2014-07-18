
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
    <p><?=$collection['description']?></p>

    <form action="" method="POST" id="payment-form" class="form-horizontal" novalidate>
        <?php if (!isset($error)) { ?>
        <div class="payment-errors alert alert-danger hide"></div>
        <?php } else { ?>
        <div class="payment-errors alert alert-danger"><strong>Whoops!</strong> <?=$error?></div>
        <?php } ?>

        <div class="form-group has-feedback">
            <label class="col-sm-2 control-label">Number</label>
            <div class="col-sm-10">
                <input type="text" pattern="\d*" autocomplete="cc-number" class="card-number form-control" onKeyUp="showCardType(this.value)" />
                <span id="card-feedback" class="glyphicon form-control-feedback"></span>
                <div class="cards">
                    <img src="/static/img/visa_24.png" alt="" id="visa" />
                    <img src="/static/img/mastercard_24.png" alt="" id="mastercard" />
                    <img src="/static/img/american_express_24.png" alt="" id="amex" />
                    <img src="/static/img/discover_24.png" alt="" id="discover" />
                    <img src="/static/img/jcb_24.png" alt="" id="jcb" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">CVV</label>
            <div class="col-sm-10">
                <input type="text" pattern="\d*" autocomplete="off" class="card-cvc form-control input-small" />
                Normally found on the back of your card, front for AmEx.
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Expiration</label>
            <div class="col-sm-10">
                <input type="text" pattern="\d*" autocomplete="cc-exp" class="card-expiry form-control input-small" placeholder="MM / YYYY" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="card-holdername" class="card-holdername form-control"<?php if (isset($cardholdername)) { echo 'value="'.$cardholdername.'"'; }?> />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="card-holderemail" class="form-control"<?php if (isset($cardholderemail)) { echo 'value="'.$cardholderemail.'"'; }?> />
            </div>
        </div>

        <button type="submit" class="btn btn-default pull-right">Process</button>
    </form>

    <script type="text/javascript" src="/static/components/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/static/components/jquery.payment/lib/jquery.payment.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="/static/js/collect.js"></script>

    <script type="text/javascript">
        Stripe.setPublishableKey('<?=$config['stripe_pk']?>');
    </script>
  </body>
</html>
