<?= $this->getContent() ?>

<div class="jumbotron text-center">
    <h1>Page not found</h1>
    <p>Sorry, you have accessed a page that does not exist or was moved</p>
    <p><?= $this->tag->linkTo(['user/index', 'Home', 'class' => 'btn btn-primary']) ?></p>
</div>
