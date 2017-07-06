<?php
    $s_result = mysql_query("SELECT * FROM sections");
?>

<script src="assets/js/forum.js"></script>

<div class="b_forum">
    <?php while($section = mysql_fetch_array($s_result)) : ?>
        <?php if($section['access'] >= USER_RULES || $section['access'] == 2) : ?>
            <div class="b_section">
                <h1 class="e_section__title heading">
                    <?= rules_icon($section['access']); ?>
                    <?= $section['title']; ?>
                </h1>

                <?php
                    $t_result = mysql_query("SELECT * FROM threads WHERE section = '" . $section['id'] . "'  ORDER BY date DESC");
                ?>

                <?php while($thread = mysql_fetch_array($t_result)) : ?>
                    <?php
                        $u_result = mysql_query("SELECT * FROM users WHERE id = '" . $thread['author'] . "' LIMIT 1");
                        $user = mysql_fetch_array($u_result);
                    ?>

                    <div class="b_section-node">
                        <a href="?page=user&uid=<?= $user['id']; ?>" class="e_section-node__photo" title="В профиль автора" style="background-image: url(<?= $user['photo']; ?>)"></a><!--
                        --><a class="b_section-node-sec-block" href="?page=thread&tid=<?= $thread['id']; ?>" title="В тему">
                            <div class="e_section-node__name">
                                <?= $user['name']; ?>
                                <?= rules_icon($user['rules']); ?>
                            </div>
                            <div class="e_section-node__title">
                                <?= ($thread['closed']) ? '<i class="icon-lock"></i>' : '' ?>
                                <?= $thread['title']; ?>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>

    <?= (USER_ID && USER_RULES < 3) ? '<a href="?page=newthread" class="e_forum__thread-add" title="Новая тема"><i class="icon-plus"></i></a>' : ''; ?>
</div>
