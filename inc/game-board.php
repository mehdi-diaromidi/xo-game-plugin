<div id="xog-game-board">
    <h2>بازی دوز</h2>
    <div class="xog-board">
        <?php for ($i = 0; $i < 9; $i++): ?>
            <div class="xog-cell" data-cell="<?php echo $i; ?>"></div>
        <?php endfor; ?>
    </div>
</div>