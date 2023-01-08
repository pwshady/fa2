<div class="dropdown d-inline-block">
    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
        <img src="/fa2/app/widgets/languageselector/src/<?= $tec_language ?>.png" alt="<?= $this->languages[$tec_language]['name'] ?>">
    </a>
    <ul class="dropdown-menu" id="lang">
        <?php foreach( $this->languages as $key => $value ):?>
        <?php if ( $tec_language == $key ) continue ?>
        <li>
            <form method="POST">
                <button class="dropdown-item" type="submit" name="<?=$this->prefix_kebab?>code" value="<?= $key ?>">
                    <img src="/fa2/app/widgets/languageselector/src/<?= $key ?>.png" alt="<?= $this->languages[$key]['name'] ?>">
                    <?= $this->languages[$key]['name'] ?>
                </button>
            </form>
        </li>
        <?php endforeach; ?>
    </ul>
</div>