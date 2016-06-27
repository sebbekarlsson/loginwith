<?php

$config = json_decode(
    file_get_contents(
        dirname(
            realpath(__FILE__)
        ) . '/config.json'
    )
);
