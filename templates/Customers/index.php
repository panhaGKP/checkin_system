<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customers
 */
//$this->fetch('layout.ajax');
$this->assign('title','Customers List');
// echo $this->request->getQuery('direction');
    $this->Breadcrumbs->add('List Customers', ['controller'=>'Customers','action'=>'index']);

?>
<div class="customers index content">
    <div class="d-flex  justify-content-between">

        <h3><?= ('Customers List') ?></h3>
        <div>
            <?= $this->Form->create(null,['type'=>'get', 'align'=>'inline'],)?>
            <?= $this->Form->control('searchText', ['label'=>'Search', 'value'=>$this->request->getQuery('searchText')])?>
            <?= $this->Form->submit('Search')?>
            <?= $this->Form->end()?>
        </div>
    </div>
    <div class="flex-row-reverse d-flex ">
        <div class="btn mt-3 bg-add-btn">
             <?php echo $this->Html->icon('bi bi-plus-lg text-white'); ?>
             <?=$this->Html->link(__('Add New Customer'), ['action' => 'add'], ['class' => 'text-white text-decoration-none']) ?>
        </div>
    </div>

    <div class="table-responsive">
<!-- ====More style use class table-striped ======-->
        <table id="test" class="table table-hover">
            <thead>
            <tr>
                <th class="table-header">
                    <?= $this->Paginator->sort('id', 'Customer ID') ?>
                    <?php if($this->request->getQuery('sort')=='id') {?>
                    <i class="bi bi-arrow-<?= $this->request->getQuery('direction')== 'desc'? 'down':'up'?>"></i>
                    <?php } ?>
                </th>
                <th class="table-header">
                    <?= $this->Paginator->sort('name') ?>
                    <?php if($this->request->getQuery('sort')=='name') {?>
                        <i class="bi bi-arrow-<?= $this->request->getQuery('direction')== 'desc'? 'down':'up'?>"></i>
                    <?php } ?>
                </th>
                <th class="table-header">
                    <?= $this->Paginator->sort('gender') ?>
                    <?php if($this->request->getQuery('sort')=='gender') {?>
                        <i class="bi bi-arrow-<?= $this->request->getQuery('direction')== 'desc'? 'down':'up'?>"></i>
                    <?php } ?>
                </th>
                <th class="table-header">
                    <?= $this->Paginator->sort('phone_number') ?>
                    <?php if($this->request->getQuery('sort')=='phone_number') {?>
                        <i class="bi bi-arrow-<?= $this->request->getQuery('direction')== 'desc'? 'down':'up'?>"></i>
                    <?php } ?>
                </th>

                <th class="actions"><?= ('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= $this->Number->format($customer->id) ?></td>
                    <td><?= h($customer->name) ?></td>
                    <?php if($customer->gender == 'm') {?>
                    <td><?= h('Male') ?></td>
                    <?php }else {?>
                    <td><?= h('Female') ?></td>
                    <?php } ?>
                    <td><?= h($customer->phone_number) ?></td>

                    <td class="actions ">
                        <?= $this->Html->link(('View'), ['action' => 'view', $customer->id] ,['class'=>'btn bg-view-btn py-0 me-2']) ?>
                        <?= $this->Html->link(('Edit'), ['action' => 'edit', $customer->id],['class'=>'btn bg-edit-btn py-0 me-2']) ?>
<!--                        <span class="deleted_button">-->
                        <?= $this->Form->postLink('Delete', ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id), 'class'=>'btn bg-delete-btn py-0 me-2']) ?>
<!--                        </span>-->
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator d-flex justify-content-between">
        <p><?= $this->Paginator->counter(('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>

        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . ('first')) ?>
            <?= $this->Paginator->prev('< ' . ('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(('next') . ' >') ?>
            <?= $this->Paginator->last(('last') . ' >>') ?>
        </ul>
    </div>
</div>
