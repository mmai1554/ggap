<?php

// $config = Yaml::parse(file_get_contents('config.yml'));

$payload = json_decode($_POST['payload']);
$LOCAL_REPO = $_SERVER['DOCUMENT_ROOT'] . "/" . $payload->repository->name;
$REMOTE_REPO = $payload->repository->url . ".git";
if (file_exists($LOCAL_REPO)) {
	shell_exec("cd {$LOCAL_REPO} && git fetch --all && git reset --hard origin/master");
} else {
	shell_exec("cd {$_SERVER['DOCUMENT_ROOT']} && git clone {$REMOTE_REPO} ");
}