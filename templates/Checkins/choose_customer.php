<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Checkin $checkin
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */

//dd($this->request->getData());
?>
<div class="column-responsive column-80">
    <div class="checkins form content">
        <?= $this->Form->create(null, ['type'=>'get','url'=> ['action'=>'searchMemberships']])?>
        <fieldset>
            <legend><?= __('Select Customer') ?></legend>
            <?php
            echo $this->Form->control('customer_id', ['options' => $customers]);
            // echo $this->Form->control('bundle_id', ['options' => $bundles]);

            ?>
        </fieldset>
        <?= $this->Form->button(__('Continue')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
