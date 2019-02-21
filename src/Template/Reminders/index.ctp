<div class="jumbotron">
    <h1 class="display-4"><?= $event->name?></h1>
    <p class="lead"><?= $event->description?></p>
    <p><?=$event->start_date?> to <?= $event->end_date?></p>
</div>

<?php
echo $this->Form->create(null);

$now = new \Cake\I18n\FrozenTime();

foreach ($event->tracks as $track) {
    ?>
    <div class="col">
        <h3><?= $track->track_name;?></h3>
        <ul class="list-unstyled">
        <?php foreach ($track->talks as $talk): ?>
        <?php
         $allow = $talk->start_date > $now;
         ?>
            <li <?= !$allow ? 'style="color:#ccc"' : null?>>
                <?php
                $talkLabel = $talk->start_date->format('D H:i') . ' - ' . $talk->talk_title;
                if (!empty($talk->speakers)) {
                    $talkLabel .= ' with ' . $talk->speakers[0]['speaker_name'];
                }

                echo $this->Form->control(
                    'reminders.' . $talk->id . '.id',
                    [
                        'type' => 'checkbox',
                        'label' => $talkLabel,
                        'class' => 'mr-3',
                        'disabled' => (!$allow) ? 'disabled' : null,
                        'escape' => false
                    ]
                );
            ?></li>
        <?php endforeach;?>
        </ul>
    </div>
    <?php
}


echo $this->Form->control('phone_number', ['label' => 'Send me an SMS reminder', 'placeholder' => 'Your phone number']);
echo $this->Form->button('Remind me ', ['class' => 'btn btn-primary']);
echo $this->Form->end();
