<?php
$configjson = <<<JSON
{
    "app": {
        "stripe_sk": "",
        "stripe_pk": "",
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
