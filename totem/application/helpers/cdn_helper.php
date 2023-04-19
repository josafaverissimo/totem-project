<?php

function base_cdn($subpath)
{
    return get_instance()->config->config["base_cdn"] . "/" . $subpath;
}
