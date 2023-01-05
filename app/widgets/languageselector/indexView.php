<div class="dropdown d-inline-block">
    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
        <img src="/fa2/app/widgets/languageselector/src/<?= $tec_language ?>.png" alt="<?= $this->languages[$tec_language]['name'] ?>">
    </a>
    <ul class="dropdown-menu" id="lang">
        <?php foreach( $this->languages as $key => $value ):?>
        <li>
            <button class="dropdown-item" onclick="test();" data-landcode="en">
                <img src="/fa2/app/widgets/languageselector/src/<?= $key ?>.png" alt="<?= $this->languages[$key]['name'] ?>">
                <?= $this->languages[$key]['name'] ?>
            </button>
        </li>
        <?php endforeach; ?>
    </ul>
</div>