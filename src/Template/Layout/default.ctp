<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        PHPUK 2019 - Hackathon
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        'bootstrap-reboot.min.css',
        'bootstrap-grid.min.css',
        'bootstrap.min.css'
    ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container clearfix">
        <div class="row">
            <div class="col-md-12">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
    <footer class="row mt-4" style="background-color:#333;color:white">
        <div class="col-lg-12 text-center">
            <p><?= $this->Html->image('https://comparisontech.com/wp-content/themes/comparisontech/img/ct-logo-standard-white.png', ['style' => 'width:200px;margin-top:15px;'])?></p>
            <p>Developed by Comparison Technologies</p>
            <p>David Yell <b>@yelldavid</b> &middot; Daniel Platt <b>@danielplatt</b></p>
        </div>
    </footer>

    <?= $this->Html->script([
        'https://unpkg.com/jquery@3.3.1/dist/jquery.min.js',
        'bootstrap.bundle.js'
    ])?>
</body>
</html>
