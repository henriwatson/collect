<?php
$configjson = <<<JSON
{
    "app": {
        "stripe_sk": "sk_test_example",
        "stripe_pk": "pk_test_example",
        "title": "Example",
    },
    "collections": {
        "example": {
            "amount": "1995",
            "capture": "true",
            "currency": "usd",
            "description": "HI BILLY MAYS HERE FOR EXAMPLE TITLE",
            "public": true,
            "receipt": true
            "statement_description": "EXAMPLE",
            "title": "Example Title",
        }
    }
}
JSON;
