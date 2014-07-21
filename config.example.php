<?php
$configjson = <<<JSON
{
    "app": {
        "title": "Example",
        "stripe_sk": "sk_test_example",
        "stripe_pk": "pk_test_example"
    },
    "collections": {
        "example": {
            "title": "Example Title",
            "description": "HI BILLY MAYS HERE FOR EXAMPLE TITLE",
            "amount": "1995",
            "currency": "usd",
            "capture": "true",
            "statement_description": "EXAMPLE"
        }
    }
}
JSON;
