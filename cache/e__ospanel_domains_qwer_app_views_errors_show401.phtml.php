<?= $this->getContent() ?>

<div class="jumbotron text-center">
    <h1>Unauthorized</h1>
    <?php if ($this->session->get('auth') !== null) { ?>
    <p>You don't have access to this option. User can only be removed by admin</p>
    <?php } else { ?>
    <p>You don't have access to this option. Please login</p>
    <?php } ?>
    <p><?= $this->tag->linkTo(['user/index', 'Home', 'class' => 'btn btn-primary']) ?></p>


</div>