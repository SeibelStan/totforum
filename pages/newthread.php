<script src="assets/js/newthread.js"></script>

<div class="b_thread">
    <h1 class="heading">Создание темы</h1>

    <input type="text" class="e_new-thread__title" placeholder="Название темы">
    <select class="e_new-thread__section">
        <?php
            $result = mysql_query("SELECT * FROM sections");
            while($section = mysql_fetch_array($result)) {
                if($section['access'] >= USER_RULES) {
                    echo '<option value="' . $section['id'] . '">' . $section['title'] . '</option>';
                }
            }
        ?>
    </select>
    <textarea type="text" class="e_new-thread__text" placeholder="Текст"></textarea>
    <button class="e_new-thread__create primary"><i class="icon-plus"></i> Создать</button>
</div>
