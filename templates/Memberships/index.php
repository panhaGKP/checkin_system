<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membership[]|\Cake\Collection\CollectionInterface $memberships
 */
//    echo date('m/d/Y');
$today_date = date("Y-m-d");
$this->assign('title','Memberships List');
$this->Breadcrumbs->add('List Memberships', ['controller'=>'memberships','action'=>'index']);
?>

<div class="memberships index content">
    <div class="d-flex  justify-content-between">
        <h3><?= h('Membership List') ?></h3>
        <?= $this->Form->control('search',['label'=>['floating'=>true], 'class'=>'']) ?>
        <div>
            <?= $this->Form->create(null,['type'=>'get','align'=>'inline'])?>
            <?= $this->Form->control('searchText', ['label'=>'Search Membership', 'value'=>$this->request->getQuery('searchText')])?>
            <?= $this->Form->submit('Search')?>
            <?= $this->Form->end()?>
        </div>
    </div>
    <div class="flex-row-reverse d-flex">
        <div class="btn mt-3 bg-add-btn ">
            <?php echo $this->Html->icon('bi bi-plus-lg text-white'); ?>
            <?= $this->Html->link(__('New Membership'), ['action' => 'add'], ['class' => 'text-decoration-none text-white']) ?>
        </div>

    </div>
    <div class="table-content">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="table-header"><?= $this->Paginator->sort('id', 'ID Number',['class'=>'hello']) ?></th>
                    <th class="table-header"><?= $this->Paginator->sort('customer_id', 'Customer Name') ?></th>
                    <th class="table-header"><?= $this->Paginator->sort('gender') ?></th>
                    <th class="table-header"><?= $this->Paginator->sort('customer_id', 'Phone Number') ?></th>
                    <th class="table-header"><?= h('Status')?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($memberships as $membership): ?>
                    <tr>
                        <td><?= $this->Number->format($membership->id) ?></td>
                        <td><?= $membership->has('customer') ? $this->Html->link($membership->customer->name, ['controller' => 'Customers', 'action' => 'view', $membership->customer->id],['class'=>'text-decoration-none text-danger']) : '' ?></td>
                        <td><?= $membership->customer->gender == 'm'?  h('Male'): h('Female') ?></td>
                        <td><?= $membership->has('customer') ? h($membership->customer->phone_number) : ''?></td>
                        <?php
                        //                    echo $membership->end_date;

                        if ($membership->end_date->toDateString() >= $today_date && $membership->start_date->toDateString() <= $today_date){?>
                            <td style="" class=" align-content-center">
                                <div style="border: 1px solid #6eec5a; background-color: #6eec5a; color: white; padding: 0 10px; border-radius: 1rem; display: inline-block" class=""> Active</div>
                            </td>
                        <?php }else{?>
                            <td style="">
                                <div style="border: 1px solid gray; background-color: gray; color: white; padding: 0 10px; border-radius: 1rem ;display: inline-block" class=""> Inactive</div>
                            </td>
                        <?php }?>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action'=> 'view', $membership->id],['class'=>'btn bg-view-btn py-0 me-2']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $membership->id],['class'=>'btn bg-edit-btn py-0 me-2 disabled']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $membership->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membership->id), 'class'=>'btn bg-delete-btn py-0 me-2']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator d-flex justify-content-between">
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>

            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
        </div>
    </div>
</div>
<script>
    $('document').ready(function(){
        $('#search').keyup(function(){
            var searchkey = $(this).val();
            searchData( searchkey );
        });

        function searchData( keyword ){
            var data = keyword;
            $.ajax({
                method: 'get',
                url : "<?php echo $this->Url->build( [ 'controller' => 'memberships', 'action' => 'search' ] ); ?>",
                data: {keyword:data},

                success: function( response )
                {
                    $( '.table-content' ).html(response);
                }
            });
        };
    });
</script>
