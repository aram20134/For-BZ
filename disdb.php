<?php
    require "db.php";
    $data = $_POST;
    echo $data['id'];
    $user = R::findOne('usersbz', 'number = :n AND phase = :ph', [':n' => $data['user'], ':ph' => $data['phase']]);
 
    if ($user['phase'] == 1) {
        $roles = R::findOne('roles', 'discordid = ?', [$user['dsid']]);
    } else {
        $roles = R::findOne('roles2', 'discordid = ?', [$user['dsid']]);
    }
    $rls = $roles['roleslist'];
    if (strpos($roles, $data['id'])) {
        $repls = "<@&".$data['id'].">,";
        $roles->roleslist = str_replace($repls, '', $roles['roleslist']);
    }
    R::store($roles);
?>