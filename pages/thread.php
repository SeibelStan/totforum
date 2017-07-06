<?php
    $tid = $_GET['tid'];
    $result = mysql_query("SELECT * FROM threads WHERE id = '$tid' LIMIT 1");
    if(mysql_num_rows($result)) {
        $thread = mysql_fetch_array($result);
        $section = $thread['section'];

        $s_result = mysql_query("SELECT access FROM sections WHERE id = '$section'");
        $r_access = mysql_fetch_array($s_result);
        $access = $r_access['access'];

        if($access < USER_RULES && $access != 2) {
            header('Location: ?page=forum');
        }
    }
    else {
        header('Location: ?page=forum');
    }
?>

<script src="assets/js/thread.js"></script>

<div class="b_thread">
    <h1 class="e_thread__title heading" data-id="<?= $tid; ?>"><?= $thread['title']; ?></h1>

    <?php
        $t_result = mysql_query("SELECT * FROM nodes WHERE thread = '$tid'");
    ?>

    <?php
        $i = 0;
        while($node = mysql_fetch_array($t_result)) :
    ?>
        <?php
            $u_result = mysql_query("SELECT * FROM users WHERE id = '" . $node['author'] . "' LIMIT 1");
            $user = mysql_fetch_array($u_result);
        ?>

        <table class="b_thread-node" data-id="<?= $node['id']; ?>">
            <tr>
                <td class="b_thread-node-prim-block">
                    <a href="?page=user&uid=<?= $user['id']; ?>" class="e_thread-node__photo" style="background-image: url(<?= $user['photo']; ?>)"></a>
                </td>
                <td class="b_thread-node-sec-block">
                    <div class="e_thread-node__name">
                        <?= $user['name']; ?>
                        <?= rules_icon($user['rules']); ?>
                    </div>
                    <div class="e_thread-node__status">
                        <div class="e_thread-node__date">
                            <?= date_reformat($node['date']); ?>
                        </div>

                        <?php if(USER_RULES < 2) : ?>
                            <?php if($i == 0 || date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime($node['date'] . ' + 1 hour'))) : ?>
                                <a class="e_thread-node__edit"><i class="icon-pencil" title="Изменить сообщение"></i></a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(USER_RULES == 0) : ?>

                            <?php if($i == 0) : ?>
                                <a href="controllers/threads.php?action=delete&tid=<?= $tid; ?>" title="Удалить тему"><i class="icon-cancel"></i></a>
                                <?php if($thread['closed'] == 0) : ?>
                                    <a href="controllers/threads.php?action=close&val=1&tid=<?= $tid; ?>" title="Закрыть тему"><i class="icon-lock"></i></a>
                                <?php else : ?>
                                    <a href="controllers/threads.php?action=close&val=0&tid=<?= $tid; ?>" title="Открыть тему"><i class="icon-lock-open-alt"></i></a>
                                <?php endif; ?>
                            <?php else : ?>
                                <a href="controllers/nodes.php?action=delete&nid=<?= $node['id']; ?>" title="Удалить сообщение"><i class="icon-cancel"></i></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="e_thread-node__text"><?= text_format($node['text']); ?><?= ($node['edited']) ? ' <i class="is-edited icon-pencil" title="Сообщение изменялось"></i>' : ''; ?></div>
                </td>
        </table>

        <?php if(USER_ID && USER_RULES < 3 && $thread['closed'] == 0 && $i == 0) : ?>
            <textarea class="e_thread__new-node-text" placeholder="Ответ"></textarea>
            <button class="e_thread__new-node-create primary"><i class="icon-reply"></i> Отправить</button>
        <?php endif; ?>

    <?php
        $i++;
        endwhile;
    ?>
</div>
