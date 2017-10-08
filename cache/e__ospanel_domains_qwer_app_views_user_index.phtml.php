<?= $this->getContent() ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div id="content">
                <div class="page-header">
                    <div class="container-fluid">
                        <div class="pull-right">
                            <?= $this->tag->linkTo([['for' => 'user-create'], 'Create', 'class' => 'btn btn-primary']) ?>
                        </div>
                        <div class="pull-left">
                            <h1></h1>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-list"></i></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <td class="text-center">
                                            <a href="">User</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="">E-mail</a>
                                        </td>
                                        <td class="text-center">
                                            <a href=""></a>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <? foreach ($page->items as $item) { ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $item->name ?>
                                            <td class="text-center">
                                                <?= $item->email ?>
                                            <td class="text-center">
                                                <?= $this->tag->linkTo([["for" => "user-edit",
                                                    'id' => $item->id], "Show", 'class' => 'btn
                                            btn-primary']) ?>
                                            </td>
                                        </tr>
                                    <? } ?>
                                    </tbody>
                                </table>
                            </div>
                            <? if (count($users) > 5) { ?>
                                <div class="text-center">
                                    <? if ($page->current > 1) { ?>
                                        <a href='/user/?page=<?= $page->before; ?>'>
                                            <?= $page->current - 1 ?>
                                        </a>
                                    <? } ?>
                                    <a style="font-weight: bold" href='/user?page=<?= $page->next; ?>'>
                                        <?= $page->current ?>
                                    </a>
                                    <? if (count($page->items) == 5) { ?>
                                        <a href='/user?page=<?= $page->next; ?>'>
                                            <?= $page->current + 1 ?>
                                        </a>
                                    <? } ?>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>