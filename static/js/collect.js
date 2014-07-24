$('input.card-number').payment('formatCardNumber');
$('input.card-expiry').payment('formatCardExpiry');

jQuery(function($) {
  $('#payment-form').submit(function(event) {
    var $form = $(this);

    if (Stripe.validateCardNumber($('.card-number').val()) == false) {
        $('.payment-errors').removeClass("hide");
        $('.payment-errors').html("<b>Uh oh!</b> Seems you didn't enter a valid card number.");
        $form.find('button').prop('disabled', false);
        return false;
    }

    if (Stripe.validateCVC($('.card-cvc').val()) == false) {
        $('.payment-errors').removeClass("hide");
        $('.payment-errors').html("<b>Uh oh!</b> Seems you didn't enter a valid CVC.");
        $form.find('button').prop('disabled', false);
        return false;
    }

    if (Stripe.validateExpiry($('.card-expiry').val().split(" / ")[0], $('.card-expiry').val().split(" / ")[1]) == false) {
        $('.payment-errors').removeClass("hide");
        $('.payment-errors').html("<b>Uh oh!</b> Seems you didn't enter a valid expiry date. Make sure it follows the MM/YYYY format");
        $form.find('button').prop('disabled', false);
        return false;
    }

    // Disable the submit button to prevent repeated clicks
    $form.find('button').prop('disabled', true);

    $form.find('.payment-errors').addClass("hide");

    Stripe.card.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry').val().split(" / ")[0],
        exp_year: $('.card-expiry').val().split(" / ")[1],
        name: $('.card-holdername').val()
    }, stripeResponseHandler);

    // Prevent the form from submitting with the default action
    return false;
  });
});

function stripeResponseHandler(status, response) {
    var $form = $('#payment-form');

    if (response.error) {
        // Show the errors on the form
        $('.payment-errors').removeClass("hide");
        $('.payment-errors').html("<strong>Whoops!</strong> " + response.error.message);
        $('button').prop('disabled', false);
    } else {
        var token = response.id;
        $('.payment-errors').addClass("hide");
        $form.append($('<input type="hidden" name="token" />').val(token));
        $form.get(0).submit();
    }
}

function showCardType(card) {
    type = $.payment.cardType(card);

    if (type == "visa") {
        $(".cards > img").css("opacity", 1);
        $(".cards :not(#visa)").css("opacity", 0.3);
    } else if (type == "mastercard") {
        $(".cards > img").css("opacity", 1);
        $(".cards :not(#mastercard)").css("opacity", 0.3);
    } else if (type == "amex") {
        $(".cards > img").css("opacity", 1);
        $(".cards :not(#amex)").css("opacity", 0.3);
    } else if (type == "jcb") {
        $(".cards > img").css("opacity", 1);
        $(".cards :not(#jcb)").css("opacity", 0.3);
    } else if (type == "discover") {
        $(".cards > img").css("opacity", 1);
        $(".cards :not(#discover)").css("opacity", 0.3);
    } else {
        $(".cards > img").css("opacity", 1);
    }

    if (card.replace(/ /g, "").length == "16") {
        if ($.payment.validateCardNumber(card)) {
            $('.card-number').parent().addClass("has-success");
            $('.card-number').parent().removeClass("has-error");
            $('#card-feedback').addClass("glyphicon-ok");
            $('#card-feedback').removeClass("glyphicon-remove");
        } else {
            $('.card-number').parent().addClass("has-error");
            $('.card-number').parent().removeClass("has-success");
            $('#card-feedback').addClass("glyphicon-remove");
            $('#card-feedback').removeClass("glyphicon-ok");
        }
    } else {
        $('.card-number').parent().removeClass("has-success has-error");
        $('#card-feedback').removeClass("glyphicon-ok glyphicon-remove");
    }
}
