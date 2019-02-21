<ul class="nav justify-content-center nav-tabs mt-3 mb-3">
    <li class="nav-item">
        <?= $this->Html->link(
            'Set reminders',
            ['controller' => 'Reminders', 'action' => 'index'],
            ['class' => ($this->request->getParam('action') === 'index') ? 'nav-link active' : 'nav-link']
        );?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link(
            'View reminders',
            ['controller' => 'Reminders', 'action' => 'view'],
            ['class' => ($this->request->getParam('action') === 'view') ? 'nav-link active' : 'nav-link']
        );?>
    </li>
</ul>
