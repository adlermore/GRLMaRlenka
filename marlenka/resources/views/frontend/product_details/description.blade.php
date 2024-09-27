<div class="bg-white mb-4 row">
    <div class="col-2">
        <p class="fs-22 fw-400">{{ translate('Details') }}</p>
    </div>

    <!-- Description -->
    <div class="col-10 fs-17">
        <?php echo $detailedProduct->getTranslation('description'); ?>
    </div>
</div>

<div class="bg-white mb-4 row">
    <!-- Tabs -->
    <div class="col-2">
        <p class="fs-22 fw-400">{{ translate('Technical') }}</p>
    </div>

    <!-- Description -->
    <div class="col-10">
        <ul class="list-unstyled technical">
            <li class="d-flex justify-content-between border-bottom">
                <p class="fs-17">Weight:</p>
                <p class="fs-17">1g</p>
            </li>
            <li class="d-flex justify-content-between mt-4 border-bottom">
                <p class="fs-17">Box dimensions:</p>
                <p class="fs-17">220 x 225 x 50 mm</p>
            </li>
            <li class="d-flex justify-content-between mt-4 border-bottom">
                <p class="fs-17">Package EAN:</p>
                <p class="fs-17">859407165263</p>
            </li>
        </ul>
    </div>
</div>

