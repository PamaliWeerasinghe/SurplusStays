<div class="modal-overlay" style="display:block;">
    <div class="modal-content">
        <h2>Switch Shop?</h2>
        <p>You already have products from <strong><?= $old_shop ?></strong> in your cart.</p>
        <p>You're trying to add products from <strong><?= $new_shop ?></strong>.</p>
        <p>Would you like to start a new order? This will clear your current cart.</p>

        <form method="POST" action="<?= ROOT ?>/customer/confirmAddFromNewShop">
            <button type="submit" name="confirm" value="yes">Yes, start new order</button>
            <button type="submit" name="confirm" value="no">Cancel</button>
        </form>
    </div>
</div>
