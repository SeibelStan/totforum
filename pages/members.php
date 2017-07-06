<script src="assets/js/members.js"></script>

<div class="b_members">
    <h1 class="heading">Все мы</h1>

    <?php
        $result = mysql_query("SELECT * FROM users ORDER BY rules");
        while($user = mysql_fetch_array($result)) :
    ?>

        <?php if($user['name']) : ?>
            <a href="?page=user&uid=<?= $user['id'] ?>" class="b_member" title="В профиль">
                <div class="e_member__photo" style="background-image: url(<?= $user['photo']; ?>)"></div><!--
                --><div class="b_member-sec-block">
                    <div class="e_member__name">
                        <?= $user['name']; ?>
                        <?= rules_icon($user['rules']) ?>
                    </div>
                    <div class="e_member__rdate"><?= date_reformat($user['rdate']); ?></div>
                </div>
            </a>
        <?php endif; ?>

    <?php endwhile; ?>
</div>
